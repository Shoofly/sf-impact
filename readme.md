#SF Impact Theme for WordPress#

Requires at least: WordPress version 4.0
Tested up to: WordPress version 4.9
Stable tag: 1.0.0

##Description##

Very customizable theme. Optional unique home page header image or post slideshow, change the background color of navigation bar and content. Our Featured Thumbnail grid area can be displayed on every page and used as a menu. Optional sidebar on the home page. Structured three column footer + alternative flexible footer sidebar.


##License##

SF Impact WordPress Theme, Copyright 2016 Shoofly Solutions
SF Impact is distributed under the terms of the GNU GPLv2 or later

Based on Underscores http://underscores.me/, (C) 2012-2015 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2015 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)

SF Impact WordPress Theme is derived from Underscores WordPress Theme, http://underscores.me/ Copyright 2013 Automattic, Inc.
Underscores WordPress Theme is distributed under the terms of the GNU GPL

SF Impact Theme bundles the following third-party resources:

# FlexSlider 2.5.0 http://www.woothemes.com/flexslider/ - Copyright (c) 2015 WooThemes

TGM Plugin Activation [https://github.com/TGMPA/TGM-Plugin-Activation]  GNU GENERAL PUBLIC LICENSE Version 2.52 copyright Copyright (c) 2011, Thomas Griffin.

Font Awesome Dave Gandy - http://fontawesome.io  
FONT: font-awesome/fonts/. License: SIL OFL 1.1 URL: http://scripts.sil.org/OFL
CODE: font-awesome/css/, font-awesome/less/, and font-awesome/scss/. License: MIT License URL: http://opensource.org/licenses/mit-license.html
DOCUMENTATION: License: CC BY 3.0 URL: http://creativecommons.org/licenses/by/3.0/ 

Chat Content post ID's [http://www.gnu.org/licenses/old-licenses/gpl-2.0.html] author David Chandra & Justin Tadlock  * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat


Shoofly Solutions Featured Image Thumbnail Grid [http://shooflysolutions.com] GNU GENERAL PUBLIC LICENSE copyright 2014-2015 http://www.shooflysoultions.com

Images:

Home Page Featured Section Images are derived from Public Domain Pictures 
Flowers.png - Petr Kratochvi License: Public Domain. Url: http://www.publicdomainpictures.net/view-image.php?image=7080&picture=sakura-trees

Drop.png - Rostislav Kralik License: Public Domain. Url: http://www.publicdomainpictures.net/view-image.php?image=38564&picture=the-impact-of-drops-detail

Impact.png - @Resa Sunshine 2016 Attribution-No Derivs

Logo.png  - Shoofly Solutions

Globe - Free Images B S K http://www.freeimages.com/photo/globe-1238288
Blue Circles - Free Images Darren Wylie - http://www.freeimages.com/photo/blue-circles-1521898


##Installation##
	
1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

##Frequently Asked Questions##

###Does this theme support any plugins?###

Impact currently includes support for Thumbnail Grid, WooThemes, and Jetpack's Infinite Scroll.

##Changelog##
* 3.92
* Update WordPress version
* 3.91
* Add bullets to ul list
* Fix styles for paragraphs and ordered lists* 3.8
* Fix wonky menu when there are children
* 3.7
* Replace default image for header
* Replace wordpress image
* Fix long menus when logo is on top
* Add new option for the logo minimum width
* Load customizer scripts using wp_add_inline_style
* Eliminate load error caused by 'enqueue jquery too soon'
* 3.6
* Fix Text Domains
* 3.5
* Add protection to scripts
* 3.4
* Add 2 sidebars to homepage and sidebar to footer
* 3.3
* Fix footer
* Fix header styles when aligned bottom *this is the last time! 
* 3.2
* Fix header sidebar display & styles 
* Add missing general theme options* 3.1 
* Syntax errors introduced in 3.0* 3.0
* Added sidebars to the home page under the header and above the content along with some default content.
* Added footer sidebar
* Fixed some spacing on the home page
* Added margins to the articles
* Make sure that global $sf_impact_Theme_Mods; is always declared
* Fix proporional sizing of flex slider when an initial height is selected.
* Make featured highlights links
* Allow edit of slide count for slide show* 2.4
* Remove URLIsValid function 
* Esc boolean string output in flex slider script
* Fix loading of flex style sheet* 2.3
* Add action for after the sf header (for child actions) header.php
* Remove is_home  when also checking is_front_page - multiple superflous 
* Remove some unused functions multiple
* Fix to load correct thumbnail grid plugin!!! functions.php 
* Fix check for valid url funtions-util.php
* Fix max size of slideshow image so it doesn't go over the viewport. app.css
* Minimize app.css & functions.js to app.min.css & functions-min.css
* Fix css output customizer.php
* Break up home page customizer options into smaller more understandable sections. Customizer.php
* Fix post header when the image is the header image. Functions.php
* Settings. Instead of setting the Customizer value (setMod) set the Default value (setDefault) as intended. Function.php 
* Fix theme url to point to correct address
* Remove empty rtl.css
* Prefix constants
* Remove .pot file
* fix missing prefixes on blog_template, is_edit_page, sfly-post_meta, customPostPages
* Fix internationalization of default customizer strings in sf_impact_setdefaults &  `Theme developed by` in the footer
* Prefix style & script handles/ use standard handles for flex-slider & font-awesome
* fix settings to be escaped on output
* 2.2.1
* Fix Version Number* 2.2
* Combine license with readme.md
* Add copyright/licensing info for images
* Tested to ensure that social media marketing section can show up in more than one location as intended
* Fix text domains (change sf_impact to sf-impact)
* Remove unecessary include files from customizer.php
* Remove non printable functions in functions.php (copyright symbol)
* Remove hard coded link in footer.pho
* Remove text that says "include" from label in customizer so that it doesn't get caught in theme check. 
= 2.1 -
* Add filter for suggested plugins  - functions.php
* Add Actions for general & home page customizer settings - customizer.php
* Load custom controls properly via customize_register action - functions.php
* Fix bug function not found in check for BBPRESS.  functions.php
= 2.0 - 
* Add Actions to Customizer for child themes
* Fix loading of custom styles
* Break up theme functions into smaller modules
* Many Bug Fixes= 1.0 - Oct 20 2015 =
* Initial release
