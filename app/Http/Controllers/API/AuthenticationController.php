<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{


//    public function __construct()
//    {
//        $this->middleware('auth:api');
//    }

    public function register(RegisterRequest $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users|email',
            'phone'=>'required|string|min:11',
            'password' => 'required|string'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('token_base_name')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }


    /**
     * @throws ValidationException
     */
//    public function login(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|string',
//
//        ]);
//
//        $user = User::query()->where('email', $request->input('email'))->first();
//        if (!$user || !Hash::check($request->input('password'), $user->password)) {
//            throw ValidationException::withMessages([
//                'email' => ['The provided credentials are incorrect.'],
//            ]);
//        }
//        return response(['Message' => 'you are logged in', 'Token' => $user->createToken('authToken')->plainTextToken]);
//    }




//    public function login(Request $request)
//    {
//        $fields = $request->validate([
//            'email' => 'required|email',
//            'password' => 'required'
//        ]);
//        $user = User::query()->where('email', $fields['email'])->first();
//        if (!$user || !Hash::check($fields['password'], $user->password)) {
//            return response([
//                'message' => 'bad creds'
//            ], 401);
//        }
//        $token = $user->createToken('token_base_name')->plainTextToken;
//        $response = [
//            'user' => $user,
//            'token' => $token
//        ];
//        return response($response, 201);
//    }







    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $token = Auth::user()->createToken('loggedIn')->plainTextToken;
            return response([
                'token' => $token,
                'message' => 'User has been logged in successfully'
            ]);
        } else {

            return response([
                'message' => 'no user has been found'
            ], 401);
        }

    }






    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'logged out'
        ];
    }




    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|min:11',
            'password' => 'required|string',
        ]);

        $user = User::query()->find(auth()->user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);

        $user->save();

        return response(['Message' => ' updated successfully', 'user' => $user]);
    }



    public function editUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|min:11',
            'password' => 'required|string',
        ]);

        $user = User::query()->find(auth()->user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);

        $user->save();

        return response(['Message' => 'information updated successfully', 'user' => $user]);
    }



}
