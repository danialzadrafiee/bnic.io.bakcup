<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use URL;

class FilepondController extends Controller
{
    public function process(Request $request)
    {
        $files = $request->allFiles();
        
        if (empty($files)) {
            return response()->json(['error' => 'No file was uploaded.'], 400);
        }
    
        $file = collect($files)->first();
        
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $path = $file->move(public_path('uploads'), $filename);
        return response()->json(['id' => URL::to(str_replace(public_path(), '', $path))]);
    }
    

    public function revert(Request $request)
    {
        $path = $request->getContent();

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response()->json(['message' => 'File reverted successfully']);
    }
}
