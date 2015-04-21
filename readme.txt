=== ImageMagick Sharpen Resized Images ===

Contributors: HansVanEijsden, niwreg
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=hans%40hansheino%2enl
Tags: sharpen, sharpening, image, images, imagick, imagemagick, resize, resized, quality, compression, photo, photos
Requires at least: 3.5
Tested up to: 4.2
Stable tag: 1.1.4
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Improve your images: Sharpens resized JPG image uploads via ImageMagick so it keeps quality, EXIF information, color profiles and crops.

== Description ==

Tired of having blurry lifeless WordPress images? This plugin sharpens resized JPG image uploads and it works with ImageMagick so it keeps quality, EXIF information and color profiles. It also maintains the crops and other image proportions.

Bonus: It enables you to have automatic contrast leveling too.

Want regular updates? Become a fan on [Facebook](https://www.facebook.com/hansvaneijsdenphotography) or follow me on [Twitter](https://twitter.com/hansvaneijsden).

== Installation ==

1. Upload `imagick-sharpen-resized-images.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. In your Wordpress Settings you'll have a new admin entry: IM Sharpen Images.

Check http://codex.wordpress.org/Managing_Plugins#Installing_Plugins for more detailed installation instructions.

== Frequently Asked Questions ==

= Are there any system requirements? =

Your host needs to have the [imagick PHP module](http://pecl.php.net/package/imagick) installed (and, of course, the [ImageMagick](http://www.imagemagick.org) program itself).
The imagick PHP module is NOT a WordPress plugin, but a module for PHP. The plugin has a built-in check for this imagick PHP module.

If you don't have the imagick PHP module installed you can still sharpen your images by using the [Sharpen Resized Images](https://wordpress.org/plugins/sharpen-resized-images/) plugin. It sharpens the images by using lower quality GD, so it strips EXIF data and it strips color profiles.

= I don't see any sharpening, why? =

* After you enable the plugin it will only sharpen new uploads. If you want to sharpen your already uploaded images you will also need the [Regenerate Thumbnails](http://wordpress.org/plugins/regenerate-thumbnails/) plugin.
* Make sure to have not only the PHP module but also the ImageMagick software installed on the server (most servers have it though).
* Still no differences? Clear your browser cache.
* If you're using Varnish cache or other server caches, empty them.
* Sharpening only works with JPG files.

= How can I adjust the amount of sharpening? =

I defined the for me optimal amount of sharpening. You can change it though by going in your Wordpress Admin Settings to the IM Sharpen Images entry. The default settings are fine though (Radius 0, Sigma 0.5, Amount 1, Threshold 0). I defaulted the threshold to 0 because personally I want to retain fine skin details in my photos. You can change it to 0.05 for noisy images if it sharpens noise too much.

= How can I reset the plugin to the default values? =

Just deactivate the plugin and (re)activate it. This will restore the default values.

== Screenshots ==

1. It sharpens the crispy high frequency details and skin perfectly
2. Bye bye blurriness
3. Admin options

== Changelog ==

= 1.1.3 =
* The Automatic Contrast Leveling checkbox bug has been fixed (thanks niwreg!)

= 1.1.2 =
* Fixed some rare errors while generating thumbnails and/or uploading images

= 1.1.1 =
* Automatic Contrast Leveling has now really been enabled by default
* Added a screenshot of the Settings page

= 1.1 =
* Added an admin settings screen which lets you change all the options more easily (thanks niwreg!)
* Added a check for the imagick PHP module installation
* Automatic Contrast Leveling has now been enabled by default, you can change it in Settings

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.1.2 =
Upgrading from 1.0? Settings are now stored in the database. Please recheck your settings by going to IM Sharpen Images in the Settings panel.

= 1.1.1 =
Settings are now stored in the database. Please recheck your settings by going to IM Sharpen Images in the Settings panel.

= 1.1 =
Settings are now stored in the database. Please recheck your settings by going to IM Sharpen Images in the Settings panel.

= 1.0 =
This fixes the WordPress blurry images problem.
