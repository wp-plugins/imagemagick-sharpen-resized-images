=== ImageMagick Sharpen Resized Images ===

Contributors: HansVanEijsden
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=hans%40hansheino%2enl
Tags: sharpen, sharpening, image, images, imagick, imagemagick, resize, resized, quality, compression, photo, photos
Requires at least: 3.5
Tested up to: 3.9.1
Stable tag: 1.0
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Improve your images: Sharpens resized JPG image uploads via ImageMagick so it keeps quality, EXIF information, color profiles and crops.

== Description ==

Tired of having blurry lifeless WordPress images? This plugin sharpens resized JPG image uploads and it works with ImageMagick so it keeps quality, EXIF information and color profiles. It also maintains the crops and other image proportions.

Bonus: You can uncomment normalizeImage() for automatic leveling.

Want regular updates? Become a fan on [Facebook](https://www.facebook.com/hansvaneijsdenphotography) or follow me on [Twitter](https://twitter.com/hansvaneijsden).

== Installation ==

1. Upload `imagick-sharpen-resized-images.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.

Check http://codex.wordpress.org/Managing_Plugins#Installing_Plugins for more detailed installation instructions.

== Frequently Asked Questions ==

= Are there any system requirements? =

Your host needs to have the [imagick PHP module](http://pecl.php.net/package/imagick) installed.
To see if you have the PHP imagick module installed, just create a blank .php page with `<?php phpinfo(); ?>` in it, execute it and search for imagick.

If you don't have the PHP imagick module installed you can still sharpen your images by using the [Sharpen Resized Images](https://wordpress.org/plugins/sharpen-resized-images/) plugin. It sharpens the images by using low quality GD, so it strips EXIF data and it strips color profiles.

= I don't see any sharpening, why? =

* After you enable the plugin it will only sharpen new uploads. There are no settings required. If you want to sharpen your already uploaded images you will also need the [Regenerate Thumbnails](http://wordpress.org/plugins/regenerate-thumbnails/) plugin.
* Still no differences? Clear your browser cache.
* If you're using Varnish cache or other server caches, empty them.
* Sharpening only works with JPG files.

= How can I adjust the amount of sharpening? =

I defined the for me optimum amount of sharpening. You can change it though by adjusting `$image->unsharpMaskImage(0,0.5,1,0);` in imagick-sharpen-resized-images.php. The first variable is the radius (0=auto), then the sigma, then the amount of sharpening and then the threshold. I also have the threshold on 0 because I want to retain fine skin details in my photos. You can change it to 0.05 for noisy images if it sharpens noise too much.

== Screenshots ==

1. It sharpens the crispy high frequency details and skin perfectly
2. Bye bye blurriness

== Changelog ==

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.0 =
This fixes the WordPress blurry images problem