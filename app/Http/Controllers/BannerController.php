<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\Image;
use Illuminate\Http\Request;
use Mockery\Exception;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('panel.admin.banners.index', compact('banners'));
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
//    public function store(BannerRequest $request)
//    {
//        try {
//            (new \App\Models\Image)->save($request, 'banners');
//            return redirect('panel.admin.banners')->with('success', 'banner create successfully');
//        } catch (Exception $exception) {
//            return redirect('panel.admin.banners', 500)->with('fail', 'failed to create banner...');
//        }
//
//    }


// در مدل BannerController
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'text' => 'required',
        ]);

        // Store the image
        $imagePath = $request->file('image')->store('banners', 'public');

        // Create the banner
        $banner = Banner::create([
            'title' => $request->input('title'),
            'text' => $request->input('text'),
        ]);

        // Associate the image with the banner
        $banner->image()->create([
            'url' => $imagePath,
        ]);

        return redirect()->route('banner.index')->with('success', 'Banner added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
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
    public function destroy($id)
    {
        try {
            $banner = Banner::query()->findOrFail($id);
            $banner->delete();
            return redirect()->route('banner.index')->with('success', 'Banner deleted');
        } catch (Exception $exception) {
            return redirect()->route('banner.index')->with('fail', 'Failed to delete banner')->status(500);
        }
    }

}
