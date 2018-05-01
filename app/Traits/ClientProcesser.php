<?php

namespace App\Traits;

use File;

trait ClientProcesser {
    public function uploadImage($pathUpload, $newImage, $oldImage = null)
    {
        if ($newImage && File::exists($newImage)) {
            if (File::exists(public_path($oldImage))) {
                File::delete(public_path($oldImage));
            }

            $newImageName = time() . uniqid(rand(), true) . '.' . $newImage->getClientOriginalExtension();
            $newImage->move(public_path($pathUpload), $newImageName);

            return ($pathUpload . $newImageName);
        }

        return false;
    }
}
