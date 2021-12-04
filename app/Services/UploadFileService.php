<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public static function uploadIfExist($fieldName, $path = '')
    {
        $fileName = "N/A";
        if (request()->hasFile($fieldName)) {
            $uploadPath = "public/";
            $fileName = request()->file($fieldName)->store($uploadPath . $path);
        }

        return $fileName;
    }

    public static function replaceIfExist($fieldName, $oldFile, $path = '')
    {
        $fileName = $oldFile;
        if (request()->hasFile($fieldName)) {
            $uploadPath = "public/";
            $fileName = request()->file($fieldName)->store($uploadPath . $path);

            //Delete old file
            if (Storage::exists($oldFile)) {
                Storage::delete($oldFile);
            }
        }

        return $fileName;
    }
}
