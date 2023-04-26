<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait Image
{
    public function uploadImage($request_file, $path_directory, $currentImage = null)
    {
        $result['upload_image'] = false;
        $result['path'] = null;

        if ($request_file) {

            $image = $request_file;
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $dir = $path_directory;
            $save_path = $path_directory.$imageName;

            if (!file_exists(public_path($dir))) {
                mkdir(public_path($dir), 0775, true);
            } else {
                File::delete(public_path($currentImage));
            }

            $image->move(public_path($dir), $imageName);

            $result['upload_image'] = true;
            $result['path'] = $save_path;

            return $result;

        } else {

            return $result;

        }
    }
}
