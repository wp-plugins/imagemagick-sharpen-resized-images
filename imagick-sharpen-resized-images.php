<?php
/*
Plugin Name: ImageMagick Sharpen Resized Images
Plugin URI: http://www.hansvaneijsden.com/wordpress-sharpen-resized-images-plugin/
Description: Improve your images: Sharpens resized JPG image uploads via ImageMagick so it keeps quality, EXIF information, color profiles and crops.
Author: Hans van Eijsden
Author URI: http://www.hansvaneijsden.com/
Version: 1.1.1
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
function imagick_sharpen_resized_files_register_settings() {
	add_option('Radius', '0');
	add_option('Sigma', '0.5');
	add_option('Sharpening', '1');
	add_option('Threshold', '0');
	add_option('CompressionQuality','92');
	add_option('AutoConLev', false);
  	register_setting( 'imagick_sharpen_resized_files_settings', 'Radius' );
	register_setting( 'imagick_sharpen_resized_files_settings', 'Sigma' );
	register_setting( 'imagick_sharpen_resized_files_settings', 'Sharpening' );
	register_setting( 'imagick_sharpen_resized_files_settings', 'Threshold' );
	register_setting( 'imagick_sharpen_resized_files_settings', 'AutoConLev' );
	register_setting( 'imagick_sharpen_resized_files_settings', 'CompressionQuality' );

} 

function imagick_sharpen_resized_files_register_options_page() {
	add_options_page('ImageMagick Sharpen Resized Images', 'IM Sharpen Images', 'manage_options', __FILE__, 'imagick_sharpen_resized_files_options_page');
}

 

function imagick_sharpen_resized_files_deactivate(){
   //delete plugins option here ex:
  delete_option('Radius');
  delete_option('Sigma');
  delete_option('Sharpening');
  delete_option('Threshold');
  delete_option('CompressionQuality');
  delete_option('AutoConLev');
}

function imagick_sharpen_resized_files_options_page() { 	// Output the options page
?>
	<div class="wrap">
	<h2>ImageMagick Sharpen Resized Images</h2>
    <p><a href="http://www.hansvaneijsden.com/wordpress-sharpen-resized-images-plugin/"><?php _e('Plugin Home Page'); ?></a> |
    <a href="http://wordpress.org/plugins/imagemagick-sharpen-resized-images/"><?php _e('WordPress Plugin Page'); ?></a></p>

<p>
<?php
        if ( extension_loaded('imagick') || class_exists("Imagick") )
{
    //Imagick is installed
echo 'ImageMagick PHP Module: <span style="color: green; font-weight: bolder">OK, installed';
        } else {
echo 'ImageMagick PHP Module: <span style="color: red; font-weight: bolder">MISSING, not installed';
        }
?>
</p>
<p>The default settings are great, but you can adjust them to your taste here: </p>

	<form method="post" action="options.php">
		<?php settings_fields( 'imagick_sharpen_resized_files_settings' ); ?>
		<?php do_settings_sections( 'imagick_sharpen_resized_files_settings' ); ?>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">Radius (0 = auto):</th>
			<td><input type="text" name="Radius" value="<?php echo get_option('Radius'); ?>" /></td>
			</tr>
			 
			<tr valign="top">
			<th scope="row">Sigma:</th>
			<td><input type="text" name="Sigma" value="<?php echo get_option('Sigma'); ?>" /></td>
			</tr>
			
			<tr valign="top">
			<th scope="row">Amount Of Sharpening:</th>
			<td><input type="text" name="Sharpening" value="<?php echo get_option('Sharpening'); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">Threshold:</th>
			<td><input type="text" name="Threshold" value="<?php echo get_option('Threshold'); ?>" /></td>
			</tr>

			<tr valign="top">
			<th scope="row">Compression Quality:</th>
			<td><input type="text" name="CompressionQuality" value="<?php echo get_option('CompressionQuality'); ?>" /></td>
			</tr>


			<tr valign="top">
			<th scope="row">Automatic Contrast Leveling:</th>
			<td><input type="checkbox" <?php if (get_option('AutoConLev')==true) echo 'checked="checked" '; ?> name="AutoConLev" value="<?php echo get_option('AutoConLev'); ?>" /></td>
			</tr>
		</table>
		
		<?php submit_button(); ?>
	</form>
    </div>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&appId=407436179311287&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like-box" data-href="https://www.facebook.com/hansvaneijsdenphotography" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
<br>
    <a href="https://twitter.com/HansVanEijsden" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @HansVanEijsden</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

	<?php
}

function imagick_sharpen_resized_files($resized_file) {
	settings_fields( 'imagick_sharpen_resized_files_settings' );
    do_settings_sections( 'imagick_sharpen_resized_files_settings' );
	
	$image = new Imagick($resized_file); 
	$size = @getimagesize($resized_file);
	if (!$size)
		return new WP_Error('invalid_image', __('Could not read image size.'), $file);
	list($orig_w,$orig_h,$orig_type) = $size;

	// We only want to use our sharpening on JPG files
	switch($orig_type) {
		case IMAGETYPE_JPEG:

	// Automatic Contrast Leveling
	if (get_option('AutoConLev')==true) {
        $image->normalizeImage();
	}

	// Sharpen the image (the default is via the Lanczos algorithm)
        $image->unsharpMaskImage(get_option('Radius'),get_option('Sigma'),get_option('Sharpening'),get_option('Threshold'));
        
    // Store the JPG file, with as default a compression quality of 92 (default WordPress = 90, default ImageMagick = 85...)
        $image->setImageFormat("jpg");
        $image->setImageCompression(Imagick::COMPRESSION_JPEG);
        $image->setImageCompressionQuality(get_option('CompressionQuality'));
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
register_deactivation_hook( __FILE__, 'imagick_sharpen_resized_files_deactivate' );
add_action( 'admin_init', 'imagick_sharpen_resized_files_register_settings' );
add_action('admin_menu', 'imagick_sharpen_resized_files_register_options_page');
