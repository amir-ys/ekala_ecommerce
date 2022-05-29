<?php

namespace Modules\Product\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ImageService
{
    public static function loadImage($filename, $dir)
    {
        $path = $dir . '\\' . $filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        };

        $path = 'public' . '\\' . $path;
        $file = Storage::get($path);
        $mimes = Storage::mimeType($path);
        $response = response()->make($file, ResponseAlias::HTTP_OK);
        $response->header('Content-Type', $mimes);
        return $response;
    }

    public static function uploadImage(UploadedFile $file, $dir = null): string
    {
        if (is_null($dir)) {
            $dir = "\\";
        } else {
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
        }

        $name = uniqid();
        $extension = $file->getClientOriginalExtension();
        $imageName = $name . '.' . $extension;
        Storage::disk('public')->putFileAs($dir, $file, $imageName);
        return $imageName;
    }

    public static function deleteImage($filename, $dir)
    {
        $path = $dir . '\\' . $filename;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
