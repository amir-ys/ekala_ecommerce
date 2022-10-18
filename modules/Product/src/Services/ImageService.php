<?php

namespace Modules\Product\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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

    public static function uploadImage(UploadedFile $file , $type  , $dir = null , $name = null): array
    {
        if (is_null($dir)) {
            $dir = "\\";
        } else {
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
        }

        if (is_null($name)) {
            $name = uniqid();
        }

        $extension = $file->getClientOriginalExtension();
        $imageName = $name;
        $path  = Storage::path('public') . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $imageName . '.' . $extension;
       return static::resize($file, $dir , $imageName , $extension , $type );
    }

    public static function deleteImage($filename, $dir)
    {
        if (is_array($filename)){
            foreach ($filename as $file){
               self::delete($dir , $file);
            }
        }else{
            self::delete($dir , $filename);
        }
    }

    private static function resize($file , $dir , $imageName , $extension , $type)
    {
        $img = Image::make($file);
        foreach (self::sizes($type) as $name => $size){
            $images[$name] = $imageName . '_' . $name . '.' . $extension;
            $img->resize($size[0], $size[1])
                ->save(Storage::path('public') . DIRECTORY_SEPARATOR . $dir .
                    DIRECTORY_SEPARATOR . $imageName . '_' .$name. '.' . $extension);
        }
        return $images;
    }

    private static function delete($dir , $filename)
    {
        $path = $dir . '\\' . $filename;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private static function sizes($type){
        return config("core.image.sizes.$type");
    }
}
