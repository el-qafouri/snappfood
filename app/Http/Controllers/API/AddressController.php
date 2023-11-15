<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = User::find(auth()->user()->id)->addresses;
        return response(['All Addresses' => $addresses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'address' => 'required|string',
//            'latitude' => 'required|numeric',
//            'longitude' => 'required|numeric',
            'latitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->where(function ($query) use ($request) {
                    return $query->where('longitude', $request->longitude);
                }),
            ],
            'longitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->where(function ($query) use ($request) {
                    return $query->where('latitude', $request->latitude);
                }),
            ],
        ]);

        $address = User::query()->find(auth()->user()->id)->addresses()->create([
            'title' => $fields['title'],
            'address' => $fields['address'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude'],
        ]);

        return response(['Message' => 'address submitted successfully', 'Address details' => $address]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $address = Address::query()->find($id);
        $request->validate([
            'title' => 'string',
            'address' => 'string',
//                'latitude' => 'numeric',
//                'longitude' => 'numeric',
            'latitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->where(function ($query) use ($request) {
                    return $query->where('longitude', $request->longitude);
                }),
            ],
            'longitude' => [
                'required',
                'numeric',
                Rule::unique('addresses')->where(function ($query) use ($request) {
                    return $query->where('latitude', $request->latitude);
                }),
            ],


        ]);
        $address->update($request->all());
        return response(['Message' => 'Your address is updated', 'Address details' => $address]);

    }

    /**
     * Set location the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function setActiveAddress($id)
    {
        $address = Address::query()->find($id);
        $gate = Gate::allows('view', $address);
//آیا کاربر مجاز به مشاهده این آدرس هست؟
        if ($gate) {
            $addresses = User::query()->find(auth()->user()->id)->addresses;
            foreach ($addresses as $address) {
                if ($address->id == $id) $address->update(['active' => '1']);
                else $address->update(['active' => '0']);
            }

            return response(['Message' => 'Your main address is updated', 'Active address' => (User::query()->find(auth()->user()->id)->addresses)->where('active', '1')]);
        }

        return response(['Message' => "You don't have access to this address"], 403);
    }



}
