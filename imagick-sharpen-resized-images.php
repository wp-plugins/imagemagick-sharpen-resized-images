<?php
/*
Plugin Name: ImageMagick Sharpen Resized Images
Plugin URI: http://www.hansvaneijsden.com/wordpress-sharpen-resized-images-plugin/
Description: Improve your images: Sharpens resized JPG image uploads via ImageMagick so it keeps quality, EXIF information, color profiles and crops.
Author: Hans van Eijsden
Author URI: http://www.hansvaneijsden.com/
Version: 1.0
License: GPL v3

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 

function imagick_sharpen_resized_files($resized_file) {
	
	$image = new Imagick($resized_file); 
	$size = @getimagesize($resized_file);
	if (!$size)
		return new WP_Error('invalid_image', __('Could not read image size.'), $file);
	list($orig_w,$orig_h,$orig_type) = $size;

	// We only want to use our sharpening on JPG files
	switch($orig_type) {
		case IMAGETYPE_JPEG:

	// Uncomment the next line if you want to have automatic contrast leveling
//        $image->normalizeImage();

	// Sharpen the image (the default is via the Lanczos algorithm)
        $image->unsharpMaskImage(0,0.5,1,0);
        
        // Store the JPG file, with compression quality 92 (default WordPress = 90, default ImageMagick = 85...)
        $image->setImageFormat("jpg");
        $image->setImageCompression(Imagick::COMPRESSION_JPEG);
        $image->setImageCompressionQuality(92);
        $image->writeImage($resized_file); 
			
			break;
		default:
			return $resized_file;
	}	
	
	// Remove the JPG from memory
	$image->destroy();
	
	return $resized_file;
}	
	
add_filter('image_make_intermediate_size','imagick_sharpen_resized_files',900);
