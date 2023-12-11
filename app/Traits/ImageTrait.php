<?php 
namespace App\Traits;

trait ImageTrait
{
    protected function uploadImage($image, $name = 'img', $path = 'products')
    {
        $imageName = time() . '_'.$name.'_' . $image->getClientOriginalName(); // Generate a unique name for the image
        $imagePath = 'assets/images/'.$path.'/' . $imageName; // Specify the storage path

        // Move the uploaded image to the storage path
        $image->move(public_path('assets/images/'.$path.''), $imageName);

        return $imagePath;
    }

    protected function updateImage($image, $name = 'img', $old_file, $path = 'products') : string 
    {
        $imageName = time() . '_'.$name.'_' . $image->getClientOriginalName(); // Generate a unique name for the image
        $imagePath = 'assets/images/'.$path.'/' . $imageName; // Specify the storage path

        // Move the uploaded image to the storage path
        $image->move(public_path('assets/images/'.$path.''), $imageName);

        // check if previous image exists
        if(file_exists($old_file))
        {
            unlink($old_file); // delete previous image
        }

        return $imagePath;
    }
}
