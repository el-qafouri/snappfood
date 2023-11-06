<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

//    public function login(LoginRequest $request)
//    {
//        if ($request->validated()) {
//            if (Auth::attempt([
//                'email' => $request->post('email'),
//                'password' => $request->post('password')
//            ])) {
//                return view('dashboard');
//            } else {
//                return redirect()->route('login.show')->withErrors([
//                    'email' => ['نام کاربری یا رمز عبور اشتباه است.'],
//                ]);
//            }
////        return redirect('auth.login');
//        }
//    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $redirectRoute = $this->getRedirectRouteForUser($user);
//
            if ($redirectRoute) {
//                session()->regenerate();
                return redirect()->route($redirectRoute);
            }
        }
        return back()->with('error', 'ایمیل یا پسووردت اشتباهه!');
    }

    private function getRedirectRouteForUser($user)
    {
        if ($user->hasRole('admin')) {
            return 'admin.dashboard';
        } elseif ($user->hasRole('seller')) {
            return 'main';
        }
        return null;
    }




    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $request)
    {

//        return redirect('dashboard');

//        dd('hiiiiiiiiiiiiii');
        $user = User::query()->create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'password' => $request->post('password')
        ]);
        return view('auth.login');
//            dd($user);
//        Auth::login($user , true);
//        return redirect()->route('login.show');
        }

    public function showRegister()
    {
//        dd('hi');
//        return redirect()->route('register.show');
        return view('auth.register');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('main');
    }

    /**
     * Display a listing of the resource.
     */
//    public function showSellerRegister()
//    {
//        return view('auth.sellerRegister');
//    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
