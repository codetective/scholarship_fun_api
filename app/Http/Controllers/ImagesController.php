<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagesRequest;
use App\Http\Requests\UpdateImagesRequest;
use App\Models\Images;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function store(StoreImagesRequest $request)
    {
        // Validate the request data
        $request->validate([
            'scholarship_application_id' => 'required|exists:scholarship_applications,id',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'application_id' => 'required|exists:scholarship_applications,id'
        ]);

        // Store the image file
        $file = $request->file('file');
        $filePath = $file->store('images', 'public'); // Make sure to store the image in the public disk

        // Create a new Image instance
        $image = new Images([
            'scholarship_application_id' => $request->input('scholarship_application_id'),
            'file_path' => $filePath,
        ]);

        // Save the Image instance
        $image->save();

        // Generate a URL for the image
        $imageUrl = Storage::url($filePath);

        // Return a response
        return response()->json(['message' => 'Image stored successfully', 'url' => $imageUrl], 201);
    }



    public function destroy(Images $image)
    {
        // Delete the image file from storage
        Storage::delete($image->file_path);

        // Delete the Image instance
        $image->delete();

        // Return a response
        return response()->json(['message' => 'Image deleted successfully']);
    }
}
