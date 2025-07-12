<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends BaseController
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', $request->input('disk', 'public'));

            return response()->json([
                'path' => Storage::disk($request->disk)->url($path),
                'id' => uniqid()
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
