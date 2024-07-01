<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    /**
     * Handle image upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ]);

        if ($request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);

            return response()->json([
                'status' => 'success',
                'message' => 'Image uploaded successfully',
                'filename' => $imageName,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to upload image',
        ], 400);
    }

    /**
     * Get image by filename.
     *
     * @param  string  $filename
     * @return \Illuminate\Http\Response
     */
    public function getImage($filename)
    {
        $filePath = 'public/images/' . $filename;

        if (Storage::disk('local')->exists($filePath)) {
            $file = Storage::disk('local')->get($filePath);
            $type = Storage::disk('local')->mimeType($filePath);

            return response($file, 200)->header('Content-Type', $type);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Image not found',
        ], 404);
    }
}
