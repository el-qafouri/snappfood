<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class AuthController extends Controller
{

    public function login()
    {
        return redirect('auth.login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register()
    {
        return redirect('auth.register');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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
