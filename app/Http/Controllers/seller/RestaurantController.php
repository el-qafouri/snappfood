<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ValidationException;
use App\Models\Address;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use App\Models\Schedule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysql_xdevapi\Exception;
use Validator;


class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Restaurant::class , 'restaurant');
    }

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny' , Restaurant::class);
        $restaurants = Restaurant::all();
        return view('panel.seller.restaurants.index', compact('restaurants'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $this->authorize('create' , Restaurant::class);
        $restaurantCategories = RestaurantCategory::all();
        return view('panel.seller.restaurants.create', compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
//        $this->authorize('create' , Restaurant::class);

        $validatedData = $request->validate([
            'restaurant_name' => 'required',
            'phone' => 'required',
            'credit_card_number' => 'required',
            'send_cost' => 'required|numeric',
            'restaurant_category_ids' => 'required',
            'selected_days' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'address' => 'nullable',
            'day',

        ]);

        try {
            $user = $request->user();

            $restaurant = new Restaurant();
            $restaurant->restaurant_name = $validatedData['restaurant_name'];
            $restaurant->phone = $validatedData['phone'];
            $restaurant->credit_card_number = $validatedData['credit_card_number'];
            $restaurant->send_cost = $validatedData['send_cost'];


            $address = $user->addresses()->first();
            $restaurant->user_id = $user->id;
            $restaurant->address = $address->title;
            $restaurant->save();

            $restaurant->restaurantCategories()->sync($validatedData['restaurant_category_ids']);

            foreach ($validatedData['selected_days'] as $index => $day) {
                $openTime = $validatedData['open_time'][$index];
                $closeTime = $validatedData['close_time'][$index];
                $schedule = new Schedule();
                $schedule->day = $day;
                $schedule->open_time = $openTime;
                $schedule->close_time = $closeTime;

                $restaurant->schedules()->save($schedule);
            }

            return redirect()->route('seller.dashboard')->with('success', $validatedData['restaurant_name'] . ' رستوران با موفقیت افزوده شد');
        } catch (ValidationException $e) {
            return redirect()->route('restaurant.create')->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('restaurant.create')->with('fail', 'رستوران افزوده نشد');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
//        $this->authorize('view' , $restaurant);
        return view('panel.seller.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
//        $this->authorize('update' , $restaurant);
        $restaurantCategories = RestaurantCategory::all();
        return view('panel.seller.restaurants.edit', compact('restaurant', 'restaurantCategories'));
    }


    public function update(Request $request, $restaurant)
    {
//        $this->authorize('update' , $restaurant);
        $validatedData = $request->validate([
            'restaurant_name' => 'required',
            'phone' => 'required',
            'credit_card_number' => 'required',
            'send_cost' => 'required|numeric',
            'restaurant_category_ids' => 'required',
            'selected_days' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'address' => 'nullable',
            'day'=>'required',
        ]);

        try {
//            $restaurant = Restaurant::findOrFail($id);
            $restaurant->fill($validatedData);
            $restaurant->address = $validatedData['address'] ?? $restaurant->address; // استفاده از address قبلی در صورت نیاز
            $restaurant->save();

            $restaurant->restaurantCategories()->sync($validatedData['restaurant_category_ids']);

            // حذف برنامه‌های زمانی که دیگر وجود ندارند
            $restaurant->schedules()->whereNotIn('day', $validatedData['selected_days'])->delete();

            // بروزرسانی و ایجاد برنامه‌های زمانی جدید
            foreach ($validatedData['selected_days'] as $index => $day) {
                $restaurant->schedules()->updateOrCreate(
                    ['day' => $day],
                    [
                        'open_time' => $validatedData['open_time'][$index],
                        'close_time' => $validatedData['close_time'][$index],
                    ]
                );
            }

            return redirect()->route('seller.dashboard')->with('success', 'رستوران با موفقیت بروزرسانی شد.');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                ->with('error', 'خطایی در به‌روزرسانی رستوران رخ داده است.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
//        $this->authorize('delete' , $restaurant);

        try {
            $restaurant->schedules()->delete();
            $restaurant->delete();
            return redirect(status: 200)->route("restaurant.index")->with('success', "restaurant deleted successfully");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect(status: 500)->route('restaurant.index')->with('fail', 'restaurant delete!');
        }
    }


    public function editProfileStatus($id)
    {
        $restaurant = Restaurant::query()->find($id);
        return view('panel.seller.restaurants.show', compact('restaurant'));
    }

    public function updateProfileStatus($id)
    {
        $restaurant = Restaurant::query()->findOrFail($id);
        $restaurant->update([
            'profile_status' => !$restaurant->profile_status]);

        return redirect()->route('restaurant.index')->with('success', 'Profile status updated successfully');
    }


    public function getLocation()
    {
        return view('panel.seller.restaurants.selectRestaurantLocation');
    }

    public function setLocation(Request $request)
    {
        $user = auth()->user();
        Log::info('Request data:', $request->toArray());

        $title = $request->input('title');
        $addressText = $request->input('address');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $existingAddress = $user->addresses->first();

        if ($existingAddress) {
            $existingAddress->update([
                'title' => $title,
                'address' => $addressText,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            $message = 'address update successfully';
        } else {
            $newAddress = new Address([
                'title' => $title,
                'address' => $addressText,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            $user->addresses()->save($newAddress);

            $message = 'address save successfully';
        }

        return redirect()->route('restaurant.create')->with('success', $message);
    }



    public function editLocation()
    {
        return view('panel.seller.restaurants.editRestaurantLocation');
    }


    public function updateLocation(Request $request )
    {

        $user = auth()->user();
        Log::info('Request data:', $request->toArray());

        $title = $request->input('title');
        $addressText = $request->input('address');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $existingAddress = $user->addresses->first();

        if ($existingAddress) {
            $existingAddress->update([
                'title' => $title,
                'address' => $addressText,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            $message = 'address update successfully';
        } else {
            $newAddress = new Address([
                'title' => $title,
                'address' => $addressText,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);

            $user->addresses()->save($newAddress);

            $message = 'address save successfully';
        }

        return redirect()->route('restaurant.edit')->with('success', $message);

    }

    }
