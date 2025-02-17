<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\image_gallery;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
     {

        $listImage = image_gallery::all();


        return view('admin.image.index', compact('listImage'));
     }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


       return view('admin.image.add');

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
{

    $validateData = $request->validate([
        'img' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        'created_at' => 'required|date',
    ]);


    if ($request->hasFile('img')) {
        $imgPath = $request->file('img')->store('uploads/anhsanpham', 'public');
    } else {
        $imgPath = 'null';
    }


    $img = image_gallery::create([
        'img' => $imgPath,
        'created_at' => $validateData['created_at'],
    ]);

    return redirect()->route('image.index');
}


    /**
     * Display the specified resource.
     */
    public function show(image_gallery $image_gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(image_gallery $image_gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, image_gallery $image_gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(image_gallery $image_gallery)
    {
        //
    }
}
