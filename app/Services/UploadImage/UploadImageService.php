<?php

namespace App\Services\UploadImage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageService
{
    public function __construct()
    {
    }

    public function imageProcessingStore($nameStorage, $img){
        try {
            $file = $img->extension();
            $genFile = Str::random(40) . "." . $file;
            Storage::putFileAs($nameStorage, $img, $genFile);
            return $genFile;
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }

    public function imageProcessingUpdate($nameStorage, $existingImage, $newImg){
        try {
            if (file_exists(storage_path('app/') . $nameStorage . @$existingImage)) {
                unlink(storage_path('app/') . $nameStorage . @$existingImage);
            }
            $files = $newImg->extension();
            $newName = Str::random(40) . "." . $files;
            Storage::putFileAs($nameStorage, $newImg, $newName);
            return $newName;
        } catch (\Throwable $e){
            return $e->getMessage();
        }
    }



}
