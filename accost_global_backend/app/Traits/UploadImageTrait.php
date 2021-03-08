<?php
namespace App\Traits;

trait UploadTrait
{
    public function uploadOne($file, $destinationPath)
    {
        $file_name =  time() . '_' . trim(preg_replace('/\s+/', '_', $file->getClientOriginalName()));
        $file->move(public_path($destinationPath), $file_name);
        return $file_name;
    }
    public function removeImage($file,$destinationPath){
    	
    }
    /*Resize an image as per required size*/
    public function ResizeImageThumbnail($image_path, $height, $width,$image){
	    $img_name_only = explode('.', $image);
	    $img_name_only = $img_name_only[0];
	    $image = new \Imagick($image_path.'/'.$image);
	    $image->thumbnailImage($width, $height);
	    $store_image_with_new_name=$image_path.'/'.$img_name_only.'_'.$width.'X'.$height.'.jpeg';
	    $image->writeImage($store_image_with_new_name);
	    $image->destroy();
	    return $img_name_only.'.jpeg';
  	}
}