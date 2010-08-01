=== Featured Page Widget ===
Contributors: GrandSlambert
Donate link: http://featuredpagewidget.grandslambert.com/donate.html
Tags: widget, page, feature, buttons, links, excerpt
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: trunk

Allows you to feature pages on your sidebar using an excerpt of the page and a text or image link to the page.

== Description ==

Allows you to feature pages on your sidebar using an excerpt of the page and a text or image link to the page.

* <strong>NEW</strong>: Added support for custom post types.
* <strong>NEW</strong>: Added support for post thumbnails.
* Added an option to set what tags are allowed in excerpts.
* Set up a random featured page by selecting multiple pages on the widget form.
* Added option to hide the widget if only one page is selected and user is viewing that page.
* Allows multiple widgets each featuring a different page.
* Use the page title or enter your own title for each widget.
* Option to link the widget title to the page.
* Uses an excerpt of your page or predefined text stored in the "featured-text" custom field.
* Set a default excerpt length which you can override for each widget.
* Adds a text link under the content, or uses the image in the "featured-link" custom field to link to the page.
* Choose alignment of link text or image in widget.
* Add an image using the "featured-image" custom field and set the alignment in the widget.

== Installation ==

1. Upload `featured-page-widget` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the default settings on the settings panel.
4. Add widgets to your sidebar.

== Changelog ==

= 1.3 - August 1st, 2010 =

* Added the ability to feature any post type, including custom types.
* Added support for post thumbnails on themes that support them.

= 1.2 - January 15th, 2010 =

* Fixed an issue on the Widget Form where defaults were always used.
* Added a "none" option for image alignment.
* Added a setting to allow user to indicate which tags are allowed in excerpts.
* Changed name from "Featured Page Widget" to "Feature Pages" to better fit in menus.
* Add support for language translation.

= 1.1 - December 18th, 2009 =

* Code cleanup and optimization.

= 1.0 - December 17th, 2009 =

* Fixed a bug to allow the plugin to work in Wordpress MU.

= 0.7 - October 19th, 2009 =

* Added a "Random" option by selecting multiple pages on the widget form. Will retain old settings without any updates.
* Added option to hide the widget if only one page is selected and user is viewing that page.
* Cleaned up some extra code left during debugging.

= 0.6 - October 16th, 2009 =

* Added basic instructions in the FAQ section and on the plugin settings page.
* Added the ability to include an image in the widget using custom fields.
* Image alignment and width added to default settings and to individual widget settings.
* Image is linked to the post.

 =0.5 - October 15th, 2009 =

* First release

== Upgrade Notice ==

= 1.3 =
Adds features from Wordpress 3.0.

= 1.1 =
Not a required upgrade, but more optimized code.

= 1.0 - Decmeber 17th, 2009 =
This version runs on Wordpress MU, no changes for standalone version.

== Frequently Asked Questions ==

= Can I set the text to use in the widget? =

Certainly. By default the plugin will create an excerpt from your page content in the length specified on the widget. However, if you would prefer to write different lead-in text, you can create a custom field with the name "featured-text". The plugin will then use the contents in the value for this custom field for use in the widget.

= Can I use a button or graphic for the post link? =

By default, the plugin uses the text set in the settings for the link in the widget. If you want to use an image instead, you will need to edit the actual page and either set a featured image or create a custom field for the featured page with the name "featued-link" and place the full URL of the image in the value field.

= How do I add an image to the widget? =

To add an image, you need to edit the page itself, not the widget, and set the featured image for the page, if your theme supports it, or add a cutom field named "featured-image" and place the full URL to the image in the value field.

= Can I have the widget feature a random page? =

As of version 0.7 you can now select multiple pages on the widget form and the widget will select a random page to feature with each page load. The widget will never display the current page as the featured page unless only one page is featured.

= Where can I get support? =

http://support.grandslambert.com/forum/featured-page-widget

== Screenshots ==
