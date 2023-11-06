<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class TestController extends Controller
{
    public function __invoke()
    {
//        dd(Role::all());
//        dd(Role::query()->first()->permissions);
//        dd(Auth::user()->roles);
    }
}
