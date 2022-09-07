<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public static function upload($request, $path, $name, $storage = 'public')
    {
        return $request->storeAs($path, $name, $storage);
    }

    public static function deleteFile($path, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }

    public static function deleteDirectory($path, $disk = 'public')
    {
        Storage::disk($disk)->deleteDirectory($path);
    }

    public static function downloadFile($path, $storage = 'public')
    {
        return Storage::disk($storage)->download($path);
    }
}
