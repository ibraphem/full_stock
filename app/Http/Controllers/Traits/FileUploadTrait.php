<?php
namespace App\Http\Controllers\Traits;

trait FileUploadTrait
{
    public function uploadImage($file, $path)
    {
        $extension = $file->getClientOriginalExtension();
        $sha = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."-".$sha.".".$extension;

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $file->move($path, $filename);
        return $path.$filename;
    }
}


