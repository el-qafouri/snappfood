<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\AddressRequest;
use App\Http\Requests\api\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
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
        $addresses = User::query()->find(auth()->user()->id)->addresses;

        return response(['All Addresses' =>  AddressResource::collection($addresses)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(AddressRequest $request)
    {
        $address = User::query()->find(auth()->user()->id)->addresses()->create($request->validated());

//        return response(['Message' => 'Address submitted successfully', 'Address details' => $address]);
        return response(['Message' => 'Address added successfully']);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    public function update(UpdateAddressRequest $request, $id)
    {
        $address = Address::query()->findOrFail($id);
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
        $specificAddress = Address::query()->findOrFail($id);
        $user = auth()->user();
        if ($user->id === $specificAddress->addressable_id && $specificAddress->addressable_type === 'App\\Models\\User') {
            $user->addresses()->update(['active' => '0']);
            $specificAddress->update(['active' => '1']);
            return response(['Message' => 'Your main address is updated']);
        }
        return response(['Message' => "You don't have access to update this address"], 403);
    }

}
