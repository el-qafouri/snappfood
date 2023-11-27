<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $banners = Banner::all();
        return view('panel.admin.banners');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $cr)
    {
        //
    }
}
