<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //Goes to the Create blade for Laravel Ajax Crud
    public function index()
    {
        // dd('new');
        $images = Image::all();
        return view('multi_images.create', compact('images'));
    }
    // Get the Ajax Data for Laravel Ajax Crud
    public function getAjaxImage()
    {
        $images = Image::all();
        return response()->json($images);
    }

    // store method for Laravel Ajax Crud
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Process each image
        $images = $request->file('images');
        foreach ($images as $image) {
            // Store the image in the 'public/multi_image' directory
            $path = $image->store('multi_image', 'public');

            // Create a new image record in the database
            Image::create([
                'title' => $request->title,
                'multi_images' => $path // Store the path relative to the public directory
            ]);
        }

        return response()->json(['message' => 'Images uploaded successfully']);
    }

    // Goes to Edit blade for Laravel Ajax Crud
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('multi_images.edit', compact('image'));
    }
    // update method for Laravel Ajax Crud
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;

        if ($request->hasFile('images')) {
            Storage::disk('public')->delete($image->multi_images);
            $path = $request->file('images')[0]->store('multi_image', 'public');
            $image->multi_images = $path;
        }

        $image->save();

        return response()->json(['message' => 'Image updated successfully']);
    }

    // Delete method for Laravel Ajax Crud
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->multi_images);
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
