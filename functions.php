<?php /**
 * sf_impact_lite_theme1 functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package shoofly
  * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */


if ( ! function_exists( 'sf_impact_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sf_impact_lite_setup() {


	load_theme_textdomain( 'sf-impact-lite', get_template_directory() . '/languages' );


    //add blog page template
    add_filter( 'template_include', 'blog_template' );
    /*
    * Overwrite page with blog template for thumbnail grid when no post category
    */
    function blog_template( $template ) {
        global $post;
        $sf_impact_lite_home_rp_categoryid = get_theme_mod('sf_impact_lite_home_rp_categoryid', "");
        $sf_impact_lite_thumbnail_more_page = get_theme_mod('sf_impact_lite_thumbnail_more_page', '');
        if (is_page() && $post) //Only display on a page if the post exists
        { 
       
            if(( $post->ID == $sf_impact_lite_thumbnail_more_page) && ($sf_impact_lite_home_rp_categoryid == "0" || $sf_impact_lite_home_rp_categoryid == ""))
            {
           
                $template = get_template_directory() . '/inc/more-posts.php';
                if( file_exists( $template ) ) {
                        return $template;
                }

            }
        }
    
        return $template;
    }    
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'sf-impact-lite' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sf_impact_lite_custom_background_args', array(
		'default-color' => '#3A3A3A',
		'default-image' => '',
	) ) );
    //add excerpt support for posts
     add_post_type_support( 'page', 'excerpt' );


     //defaults
    $sf_impact_lite_demo_data = get_theme_mod("sf_impact_lite_demo_data", TRUE);
    if ($sf_impact_lite_demo_data)
    {
        $defaultpath =        get_template_directory_uri() . '/images/';
        $defaultlogo = $defaultpath . "logo.png"; 
        $defaultheader = $defaultpath . "impact.png";
        $defaultheadertype = "0";
  
        set_theme_mod('sf_impact_lite_header_image', $defaultheader);
        set_theme_mod('sf_impact_lite_logo_image', $defaultlogo);
        set_theme_mod('sf_impact_lite_logo_location', 'image');
        set_theme_mod('sf_impact_lite_home_header_type', $defaultheadertype);
        set_theme_mod('sf_impact_lite_highlight_boxes', 2);
        set_theme_mod('sf_impact_lite_highlight_header1', 'Up to 3 highlights');
        set_theme_mod('sf_impact_lite_highlight_image1', $defaultpath . 'idea.png');
        set_theme_mod('sf_impact_lite_highlight_text1', 'Create up to 3 highlight boxes!');
        set_theme_mod('sf_impact_lite_highlight_link1', '#'); 
        set_theme_mod('sf_impact_lite_highlight_header2', 'Home Page features');
        set_theme_mod('sf_impact_lite_highlight_image2', $defaultpath . 'home.png');
        set_theme_mod('sf_impact_lite_highlight_text2', 'Display an image or a slide show!');
        set_theme_mod('sf_impact_lite_highlight_link2', '#'); 
        set_theme_mod('sf_impact_lite_home_featured_highlights', true);
        set_theme_mod('sf_impact_lite_demo_data', false);
     }
}
endif; // sf_impact_lite_setup
add_action( 'after_setup_theme', 'sf_impact_lite_setup' );
/**
 * Set the content width in pixels
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}
//Register suggested theme plugins
require_once dirname( __FILE__ ) . '/pluginauth/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'sf_impact_lite_plugins' );

if (!function_exists('sf_impact_lite_plugins')):
/**
 * Sugested plugins 
 *
 * TGM Plugin Activation
 *
 */
    function sf_impact_lite_plugins() {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(


            
            array(
                'name'      => 'Featured Image Thumbnail Grid',
                'slug'      => 'thumbnail-grid',
                'required'  => false,
            ),
  
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'default_path' => '',                      // Default absolute path to pre-packaged plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'sf-impact-lite' ),
                'menu_title'                      => __( 'Install Plugins', 'sf-impact-lite' ),
                'installing'                      => __( 'Installing Plugin: %s', 'sf-impact-lite' ), // %s = plugin name.
                'oops'                            => __( 'Something went wrong with the plugin API.', 'sf-impact-lite' ),
                'notice_can_install_required'     => __( 'This theme requires the following plugin: %1$s.',  'sf-impact-lite' ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'sf-impact-lite' ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'sf-impact-lite'), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'sf-impact-lite'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.',  'sf-impact-lite'), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.',  'sf-impact-lite'), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'sf-impact-lite' ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'sf-impact-lite' ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins',  'sf-impact-lite'),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'sf-impact-lite' ),
                'return'                          => __( 'Return to Required Plugins Installer', 'sf-impact-lite' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'sf-impact-lite' ),
                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'sf-impact-lite' ), // %s = dashboard link.
                'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa( $plugins, $config );

    }
endif;
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
 if (!function_exists('sf_impact_lite_widgets_init')):
    function sf_impact_lite_widgets_init() {
	    register_sidebar( array(
		    'name'          => esc_html__( 'Sidebar', 'sf-impact-lite' ),
		    'id'            => 'sidebar-1',
		    'description'   => '',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
	    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );

	    register_sidebar( array(
		    'name' => __( 'Left Footer Sidebar', 'sf-impact-lite' ),
		    'id' => 'sfly-footersidebar-left',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' => "</aside>",
			    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );
    	    register_sidebar( array(
		    'name' => __( 'Middle Footer Sidebar', 'sf-impact-lite' ),
		    'id' => 'sfly-footersidebar-middle',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' => "</aside>",
		    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );
    	    register_sidebar( array(
		    'name' => __( 'Right Footer Sidebar', 'sf-impact-lite' ),
		    'id' => 'sfly-footersidebar-right',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' => "</aside>",
			    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );

    }
endif;
add_action( 'widgets_init', 'sf_impact_lite_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

if (!function_exists('sf_impact_lite_scripts')):
    function sf_impact_lite_scripts() {
 

        $themedir = get_template_directory_uri();
       
        wp_register_style("sf_impact_lite_theme_styles", "$themedir/styles/app.css", "1.0");
      
        wp_enqueue_style("sf_impact_lite_theme_styles");
        
        $custom_style =  get_theme_mod('sf_impact_lite_color_theme', "light") ;
        $linkTheme = new sf_impact_lite_CustomLinkThemes( 'sf-impact-lite' );
       
        wp_register_style('sf_impact_lite_custom_styles', $linkTheme->getCustomThemePath( $custom_style ), "1.0");
        wp_enqueue_style('sf_impact_lite_custom_styles');
        add_editor_style( "$themedir/styles/app.css", "$themedir/style-parts/$custom_style-scheme.css"); 
        wp_enqueue_script('jquery');
        wp_enqueue_script('	jquery-ui-tooltip');
        if ( class_exists( 'bbPress' ) ) 
        {
            body_class( 'forum' );
            $slug = bbp_get_root_slug();
            $dir = site_url();
    
            $curpath = sf_impact_lite_geturi();
            $bbspath = "$dir/$slug";
                  
            $cmp = stripos($curpath,  $bbspath); 
            if ( $cmp !== false)
            {
                    wp_register_style("sf_impact_lite_bbspress", "$themedir/styles/bbspress.css", "1.0");
                    wp_enqueue_style("sf_impact_lite_bbspress");
            }
        }
 
        $home = is_home() || is_front_page();
        if ($home)
        {
   
    
           $sf_impact_lite_home_header_type = get_theme_mod('sf_impact_lite_home_header_type', "0");
            if ($sf_impact_lite_home_header_type == "1")
            {
              
               add_action( 'wp_footer', 'sf_impact_lite_slideshow_scripts');
            }
           wp_register_style( '_sf_impact_lite_header_styles', $themedir . '/styles/home.css', array(), '1.0');
           wp_enqueue_style( '_sf_impact_lite_header_styles' );
           if ($sf_impact_lite_home_header_type == "1")
           {
                wp_register_style( 'flex_style', $themedir . '/flexslider/flexslider.css', array(), '2.5.0');
                wp_enqueue_style("flex_style");
                wp_register_script('flex_script', $themedir . '/flexslider/jquery.flexslider-min.js', array(), "2.5.0");
                wp_enqueue_script('flex_script');
  

           }
        }
        if (sf_impact_lite_is_grid())
        {
            wp_register_script('thumbnail_grid_script', plugins_url() . '/thumbnail-grid/js/thumbnailgrid.js' );
            wp_enqueue_script("thumbnail_grid_script");
        }

	  //  wp_enqueue_style( 'shoofly-style', get_stylesheet_uri() );
	    wp_enqueue_script( 'shoofly-navigation', get_template_directory_uri() . '/js/functions.js', array(), '20120206', true );
        wp_register_style('font_awesome', get_template_directory_uri() . "/font-awesome/css/font-awesome.min.css", '4.4');
        wp_enqueue_style('font_awesome');
    /*	wp_enqueue_script( 'shoofly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );*/

	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		    wp_enqueue_script( 'comment-reply' );
	    }
       // add_editor_style('style.css');
    }
endif;
add_action( 'wp_enqueue_scripts', 'sf_impact_lite_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
* Load Custom Controls for Customizr
*/
require get_template_directory() . '/inc/imagesize-dropdown-custom-control.php';    //Image Size
require get_template_directory() . '/inc/category-dropdown-custom-control.php';     //Category
require get_template_directory() . '/inc/page-dropdown-custom-control.php';         //Page
require get_template_directory() . '/inc/arbitrary-custom-control.php';             //Label & Header Text, LInes
require get_template_directory() . '/inc/color-custom-control.php';                 //Color
require get_template_directory() . '/inc/number-custom-control.php';                //Number & Range

//Use the addin Advanced Excerpts for Excerpt display
//Filters
/**

* This should enable embeds in the excerpt
*/
add_filter('the_excerpt', array($GLOBALS['wp_embed'], 'autoembed'), 9);



/* 
* Restrict WP_Query to category on the home page
* Query - the query
*/
if (!function_exists('sf_impact_lite_home_category')):                           
  function sf_impact_lite_home_category( $query ) {
           
    $sf_impact_lite_home_rp_categoryid = get_theme_mod('sf_impact_lite_home_rp_categoryid', "");
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', $sf_impact_lite_home_rp_categoryid );
    }
  }
       
 endif;  


/*
* Array of possible Social Media Icons
*/
if (!function_exists('sf_impact_lite_social_icons_array')):
     function sf_impact_lite_social_icons_array() {
 
		return array( 'twitter', 'facebook', 'google-plus', 'flickr', 'pinterest', 'youtube', 'vimeo', 'tumblr', 'dribbble', 'rss', 'linkedin', 'instagram', 'user',  'shopping-cart');
  }
  endif;
/*
* Array of possible Social Media Links
*/
if (!function_exists('sf_impact_lite_social_media_array')):
     function sf_impact_lite_social_media_array() {
 
	// store social site names in array
	$social_sites = array( 
        __('twitter', 'sf-impact-lite'), 
        __('facebook', 'sf-impact-lite'), 
        __('google-plus', 'sf-impact-lite'), 
        __('flickr',  'sf-impact-lite'), 
        __('pinterest', 'sf-impact-lite'), 
        __('youtube', 'sf-impact-lite'), 
        __('vimeo', 'sf-impact-lite'), 
        __('tumblr', 'sf-impact-lite'), 
        __('dribbble', 'sf-impact-lite'), 
        __('rss', 'sf-impact-lite'),
        __('linkedin', 'sf-impact-lite'), 
        __('instagram', 'sf-impact-lite'), 
        __('account', 'sf-impact-lite'),  
        __('shopping-cart', 'sf-impact-lite'));
 
	return $social_sites;
  }
  endif;
/*
* Display Social Media Icons
*/
if (!function_exists('sf_impact_lite_social_media_icons')):

    function sf_impact_lite_social_media_icons() {
     
        $social_sites = sf_impact_lite_social_media_array();
        $social_icons = sf_impact_lite_social_icons_array();
 
        // any inputs that aren't empty are stored in $active_sites array
         $sf_impact_lite_icon_size = get_theme_mod('sf_impact_lite_icon_size', 'lg');
        for ($i=0; $i < count($social_sites); ++$i) 
       {

            $social_site = $social_sites[$i];
            if( strlen( get_theme_mod( $social_site ) ) > 0 ) {
                
                $active_sites[] = $social_site;
                $links[] = get_theme_mod( $social_site );
                $icons[] = $social_icons[$i];
            }
        }
 
        // for each active social site, add it as a list item 
        if(!empty($active_sites)) {
          ?><div id="shoofly-social-media-container" class="fixed">
                <div id="shoofly-social-media"><?php
                for ($i=0; $i < count($active_sites); ++$i)
                {
                    $site = $active_sites[$i];
                    $link = $links[$i];
                    $icon = $icons[$i];
                ?>
   
                    <a href="<?php echo $link?>" target="_blank" title="<?php echo ucfirst($site); ?>"><i class="fa fa-<?php echo $icon?> fa-<?php echo $sf_impact_lite_icon_size ?>"></i></a>
                <?php }?>
           </div><!--shoofly-social-media-->
        </div><!--shoofly-social-media-container--><?php
        
    }
   }
 endif;
//=========================================================Functions
/*
* Generate Style for the home page header 
*/
if (!function_exists('sf_impact_lite_get_home_header_style')):
    function sf_impact_lite_get_home_header_style()
    {
            $sf_impact_lite_header_height = get_theme_mod('sf_impact_lite_header_height', "");
            $sf_impact_lite_header_width = get_theme_mod( 'sf_impact_lite_header_width', "100%");
            $style = sf_impact_lite_get_home_header_width() . sf_impact_lite_get_home_header_height();
            return $style;
    }
endif;
if (!function_exists('sf_impact_lite_get_home_header_width')):
    function sf_impact_lite_get_home_header_width()
    {
           
            $sf_impact_lite_header_width = get_theme_mod( 'sf_impact_lite_header_width', "100%");
            $style = "";
            if ($sf_impact_lite_header_width != '')
                        $style .= "width:" . $sf_impact_lite_header_width . "!important;";
        
  
            return $style;
    }
endif;
if (!function_exists('sf_impact_lite_get_home_header_height')):
    function sf_impact_lite_get_home_header_height()
    {
            $sf_impact_lite_header_height = get_theme_mod('sf_impact_lite_header_height', "");
            $style = "";
        
            if ($sf_impact_lite_header_height)
                    $style .= "height:" . $sf_impact_lite_header_height . "!important;";
            return $style;
    }
endif;
/* 
* Custom Styles
*/

/*
* Footer style for the home page if the header is a slideshow
*/

if (!function_exists('sf_impact_lite_slideshow_scripts')):

    function sf_impact_lite_slideshow_scripts()
    {
       
        $sf_impact_lite_slider_transition = get_theme_mod('sf_impact_lite_slider_transition', 'fade');
        $sf_impact_lite_slider_animspeed = get_theme_mod('sf_impact_lite_slider_animspeed', '500');
        $sf_impact_lite_slider_speed = get_theme_mod('sf_impact_lite_slider_speed', '7000');
        $sf_impact_lite_slider_automate = get_theme_mod('sf_impact_lite_slider_automate', true)  == TRUE ? 'true' : 'false';
        $sf_impact_lite_slider_direction = get_theme_mod('sf_impact_lite_slider_direction', 'horizontal');
        $sf_impact_lite_slider_navigation = get_theme_mod('sf_impact_lite_slider_navigation', FALSE) == TRUE ? "true" : "false";
        $sf_impact_lite_slider_navdirection = get_theme_mod('sf_impact_lite_slider_navdirection', FALSE) == TRUE ? "true" : "false";
        $sf_impact_lite_slider_keyboard = get_theme_mod('sf_impact_lite_slider_keyboard', true) == TRUE ? "true" : "false";
        $sf_impact_lite_slider_mousewheel = get_theme_mod('sf_impact_lite_slider_mousewheel', true) == TRUE ? "true" : "false";
        $sf_impact_lite_slider_pauseonhover = get_theme_mod('sf_impact_lite_slider_pauseonhover', false) == TRUE ? "true" : "false";

         ?>
       	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider(
            {
                animation: "<?php echo $sf_impact_lite_slider_transition;?>",              //String: Select your animation type, "fade" or "slide"
                slideDirection: "<?php echo $sf_impact_lite_slider_direction; ?>",   //String: Select the sliding direction, "horizontal" or "vertical"
                slideshow: <?php echo $sf_impact_lite_slider_automate; ?>,                //Boolean: Animate slider automatically
               useCSS: false,
                slideshowSpeed: <?php echo $sf_impact_lite_slider_speed?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationDuration: <?php echo $sf_impact_lite_slider_animspeed ?>,         //Integer: Set the speed of animations, in milliseconds
                directionNav: <?php echo $sf_impact_lite_slider_navdirection ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
                controlNav: <?php echo $sf_impact_lite_slider_navigation ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                keyboardNav: <?php echo $sf_impact_lite_slider_keyboard?>,              //Boolean: Allow slider navigating via keyboard left/right keys
                mousewheel: <?php echo $sf_impact_lite_slider_mousewheel?>,               //Boolean: Allow slider navigating via mousewheel
                prevText: "Previous",           //String: Set the text for the "previous" directionNav item
                nextText: "Next",               //String: Set the text for the "next" directionNav item
                pausePlay: false,               //Boolean: Create pause/play dynamic element
                pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
                playText: 'Play',               //String: Set the text for the "play" pausePlay item
                randomize: false,               //Boolean: Randomize slide order
                slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
                animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
                pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: <?php echo $sf_impact_lite_slider_pauseonhover?>,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                controlsContainer: "flexslider",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
                manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
 
            });
            
		});
        </script>
        <?php        
     }
 endif;

/*
* Main code for the Home Page Header
*/
if (!function_exists('sf_impact_lite_homeheader')):
    function sf_impact_lite_homeheader()
    {
        $top = TRUE;
      
  
        $sf_impact_lite_header_image = get_theme_mod('sf_impact_lite_header_image', '');
        $sf_impact_lite_logo_location = get_theme_mod('sf_impact_lite_logo_location', 'image');
        $sf_impact_lite_home_header_type = get_theme_mod('sf_impact_lite_home_header_type', '3');
     
      
        if ($sf_impact_lite_header_image && $sf_impact_lite_logo_location == 'image')
            $top = FALSE;
            
        $style = sf_impact_lite_get_home_header_style();
 
    
   
         if ($sf_impact_lite_home_header_type == "1")
         {     
            $wstyle = sf_impact_lite_get_home_header_width();
            $hstyle = sf_impact_lite_get_home_header_height();
            sf_impact_lite_get_slideshow($wstyle, $hstyle);
         }
         else 
         {
             if ($sf_impact_lite_header_image && $sf_impact_lite_home_header_type == "0")
             {
                ?>

                <img class="headerimg headerimg-home" alt="header" style="<?php echo  $style?>;" src="<?php echo $sf_impact_lite_header_image?>"/>
           
                <?php 
                $output = "";
                $output = apply_filters('sf_impact_lite_home_post_bar', $output);
                if ( $output != '' )
                {
                    ?><div id="homepostbar">
                    <?php
                            echo $output;?>
                    </div>
                    <?php
                }
             }
         }
    
    }
endif;

/*
* Create the settings for the thumbnail grid array. 
* $type = page or post
* $category = the category to display
* $posts = Number of posts to display
* $height = Height of thumbnail if not default
* $width = Width of thumbnail if not default
* $imagesize = wordpress image size (ie, thumbnail, medium, etc)
* $cellwidth - not currently used - use cell width & height to display even grid when image sizes are not uniform.
* $cellheight - not currently used
*/
if (!function_exists('sf_impact_lite_get_thumbnailarray')):
    function sf_impact_lite_get_thumbnailarray($type, $category, $posts, $height, $width,  $imagesize, $cellwidth, $cellheight, $captionwidth, $gridwidth )
    {
    
         $arra = array('post_type' => $type, 'posts_per_page' => $posts,  'aligngrid' => 'autocenter',   'imagesize' => $imagesize, 'cellwidth' => $cellwidth, 'cellheight'=>$cellheight, 'captionwidth' => $captionwidth, 'ignore_sticky_posts' => 1);

           if ($height)
                $arra['height'] = $height;
            if ($width)
                $arra['width'] = $width;
        if ($category)
                $arra['cat']  = $category;
        if ($gridwidth)
            $arra['gridwidth'] = $gridwidth;
        return ($arra);
    }
endif;
/*
* Get the URL of the post thumbnail 
*/
//Get thumbnail url
if (!function_exists('sf_impact_lite_get_thumbnailurl')):
    function sf_impact_lite_get_thumbnailurl($category, $page)
    {
        if ($category)
            $url = get_category_link($category);
        else
            $url = get_permalink( $page );
        return $url;
    }
endif;
/*
* Display Featured Highlight Boxes
*/
if (!function_exists('sf_impact_lite_get_highlightboxes')):
    function sf_impact_lite_get_highlightboxes()
    {
      
        $sf_impact_lite_highlight_boxes = get_theme_mod('sf_impact_lite_highlight_boxes', 0);
        $boxcount = intval( $sf_impact_lite_highlight_boxes );
        if ($boxcount > 0) 
        { 
            $sf_impact_lite_highlight_style = get_theme_mod('sf_impact_lite_highlight_style', "L");
         
            for ($x = 0; $x <= 3; ++$x) 
            {
                ${'sf_impact_lite_highlight_image' . $x} = get_theme_mod('sf_impact_lite_highlight_image' . $x, '');
                ${'sf_impact_lite_highlight_header' . $x} = get_theme_mod('sf_impact_lite_highlight_header' . $x, '');
                ${'sf_impact_lite_highlight_text' . $x} = get_theme_mod('sf_impact_lite_highlight_text' . $x, '');
                ${'sf_impact_lite_highlight_link' . $x} = get_theme_mod('sf_impact_lite_highlight_link' . $x, '#');
            }

 
    
    
         ?>
    
            <div class="home-highlight-boxes fixed sfcenter">
                <?php
 
                $grid = 12/$boxcount;
                for ($x = 1; $x <= $boxcount; $x++)  :?>

                    <div class="highlight-<?php echo $boxcount ?>-col highlight-box highlight-box-<?php echo $boxcount?> grid_<?php echo $grid;?> sfchild">
                       <div class="highlight-box-container fixed " >
                        <?php 
                        switch ($sf_impact_lite_highlight_style)
                        {
                        default:
                        case ('L'):
                        {
                           if (${'sf_impact_lite_highlight_image' . $x} != "")
                           {    sf_impact_lite_getHightlightImg(${'sf_impact_lite_highlight_image' . $x}, "highlight-left-img highlight-img-$x", ${"sf_impact_lite_highlight_text$x"});     
                                $class="highlight-right-text highlight-text-$x";
                            }
                            else
                            {
                                    $class="highlight-full highlight-text-$x";
                            }
                            sf_impact_lite_getHightlightText  (${"sf_impact_lite_highlight_header$x"} ,  ${"sf_impact_lite_highlight_text$x"}, $class); 
                        break;
                        }
                        case ("T"):
                        {
                            if (${'sf_impact_lite_highlight_image' . $x} != "")
                            {
                                 sf_impact_lite_getHightlightImg(${'sf_impact_lite_highlight_image' . $x}, "highlight-top-img highlight-img-$x", ${"sf_impact_lite_highlight_text$x"});
                            }
                             sf_impact_lite_getHightlightText  (${"sf_impact_lite_highlight_header$x"} ,  ${"sf_impact_lite_highlight_text$x"}); 
                            break;
                         }        
                        case ("R"):
                        {
                                            
                           if (${'sf_impact_lite_highlight_image' . $x} != "")
                           {        
                                $class="highlight-left-text highlight-text-$x";
                            }
                            else
                            {
                                    $class="highlight-full highlight-text-$x";
                            }
                             sf_impact_lite_getHightlightText  (${"sf_impact_lite_highlight_header$x"} ,  ${"sf_impact_lite_highlight_text$x"}, $class); 
                            if (${'sf_impact_lite_highlight_image' . $x} != "")
                            {        
                                 sf_impact_lite_getHightlightImg(${'sf_impact_lite_highlight_image' . $x}, "highlight-right-img highlight-img-$x", ${"sf_impact_lite_highlight_text$x"});    
                            }
                           break;
                    
                        }
                        }
                        if (${'sf_impact_lite_highlight_link' . $x} != "")
                            {?>
                              <div class="highlight-link"><a class="read-more btn" href="<?php echo ${'sf_impact_lite_highlight_link' . $x};?>">more</a></div>   
                
 
                        <?php 
                            }?>
                        </div><!--highlight box container-->
                    </div><!--highlight box-->
    
            <?php
            endfor;
            ?>
            </div> 
            <!--highlight boxes-->

            <hr class="home1">
            <?php
        }
    }    
endif;
/*
* Get the html for the image for the featured highlight
* $imagename - path to the image
* $class - class for the img div (Image can be on top, left or right of box)
*/
if (!function_exists('sf_impact_lite_getHightlightImg')):
    function sf_impact_lite_getHightlightImg($imagename, $class, $alt)
    {
 
        ?>
            <div class="<?php echo $class?>">
                <img class="highlight-img" alt="<?php echo $alt?>" src="<?php echo $imagename ;?>"/>
            </div>  <!--highlight-left-img-->
        <?php   
    }
endif;
/*
* Get the html for the featured image highlight text
* $header - highlight header text
* $text - highlight description text
* $class - div class (text can be below image, to the right or to the left)
*/ 
if (!function_exists('sf_impact_lite_getHightlightText')):
    function sf_impact_lite_getHightlightText($header, $text, $class="highlight-full")
    {?>
        <div class="<?php echo $class?>"> 
            <span class="highlight-span">
                <h2><?php echo $header?></h2>
                <p><?php echo $text;?></p>
            </span>
        </div><!--<?php echo $class?>-->
    <?php
     }
endif;
/*
* Checks to display the thumbnail grid on a page
*/
 if (!function_exists('sf_impact_lite_is_grid')):
    function sf_impact_lite_is_grid()
    {
        $grid = FALSE;
        $sf_impact_lite_grid_display = get_theme_mod('sf_impact_lite_grid_display', FALSE);
        $sf_impact_lite_grid_display_all = get_theme_mod('sf_impact_lite_grid_display_all', FALSE);
      
           //Load script for thumbnail grid
         if (class_exists('sfly_thumbnailgrid'))
        {
            if (is_home() || is_front_page())
            {
                if ($sf_impact_lite_grid_display)
                    $grid = true;
            }
            else
                if ($sf_impact_lite_grid_display_all)
                    $grid = TRUE;
        }
       
        return $grid;
    }
endif;
/*
* HTML for the Home Page Slide Show
* $style - style for the slide show, height and width if not default
*/
if (!function_exists('sf_impact_lite_get_slideshow')):
    function sf_impact_lite_get_slideshow($wstyle, $hstyle)
    {
        
          $format =  get_theme_mod('sf_impact_lite_slider_style', 'default');
          $sf_impact_lite_slider_captions = get_theme_mod('sf_impact_lite_slider_captions', TRUE) ;
          if ($wstyle) 
                $fstyle = "style=$wstyle;"; 
           else 
                $fstyle="";
           if ($hstyle)
                $fhstyle = "style=$hstyle";
            else
                $fhstyle = "";
            ?>
         
    		<div class="flexslider"  <?php echo $fstyle;?>> 
		    <ul class="slides">
		   
  
                    <?php 
                     wp_reset_query();
                     $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 5,
                            'meta_query' => array(
                            array(
                            'key' => 'post_show_in_slideshow',
                            'value' => 1,
                            )));
                    $the_query =   new WP_Query($args);
               
                     $sf_impact_lite_slider_thumbnails = get_theme_mod('sf_impact_lite_slider_thumbnails', false) == TRUE ? "true" : "false";
                     while ( $the_query->have_posts() )  :$the_query->the_post();
                            $permalink = get_permalink();
                            $title = get_the_title();
                            $id = get_the_ID();
                            $image_id = get_post_thumbnail_id();
                            $image_atts = wp_get_attachment_image_src($image_id, "full", true);
                            $image_url = $image_atts[0] ;

                            $tnimage_atts = wp_get_attachment_image_src($image_id, "thumbnail", true);
                            $tnimage_url = $tnimage_atts[0];
                            if ($sf_impact_lite_slider_thumbnails)
                                $datathumb = "data-thumb='$tnimage_url'";
                            else
                                $datathumb = "";
                            if ($image_url && strpos($image_url, 'default.png') == FALSE)
                            {
                                $hid = "title" . $id;
                                ?>
                 	            <li <?php echo $datathumb?>>
		    		            <a href="<?php echo $permalink ?>"><img src="<?php echo $image_url?>" alt="<?php echo $hid?>" <?php echo $fhstyle; ?>/>
                                <?php if ($sf_impact_lite_slider_captions==true) { ?>
		    		                <p class="flex-caption"><?php echo $hid?></p>
		    	                <?php } ?></a>
                                 </li>
                           <?php }
                     
                     endwhile;
                     wp_reset_query();
   
                    ?> 
                </ul><!--slides-->
                </div><!--flexslider-->
        
         <?php
    }
 endif;
 if (!function_exists('sf_impact_lite_home_query')):
 function sf_impact_lite_home_query()
 {
     	wp_reset_postdata();
       
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } else if ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $args = array( 'post_type' => 'post', 'paged' => $paged );  
        $the_query = new WP_Query($args);
    
        sf_impact_lite_posts($the_query);

        wp_reset_postdata();
        
 }
 endif;
 /*
 * Display the blog posts on the home page or the blog page when the home page is a static page
 */
if (!function_exists('sf_impact_lite_posts')):
    function sf_impact_lite_posts($the_query, $stickycount = 0)
    {
        $full  = sf_impact_lite_postContentFull();
    

        if ( $the_query->have_posts() ) :  ?>
        <div>
  		<?php /* Start the Loop */ ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
               <?php
                $current_post_index = $the_query->current_post ;   //Get the current index
                $full  = sf_impact_lite_postContentFull();  //Check to see if the option to display excerpts is on or off
                $sf_impact_lite_show_full_sticky_post = FALSE;  //Check to see if the sticky as full post option is on 
                if (is_sticky() && !$full)  //The sticky as full post is only valid when excerpts are enabled.
                   $sf_impact_lite_show_full_sticky_post = (get_theme_mod('sf_impact_lite_show_full_sticky_post', true) && $current_post_index  == 0);      //Make sure that all sticky posts at the top display as full if this is set
                ?>      
			<?php
                if ($full || get_post_format() == "link")
				    get_template_part( 'template-parts/content', get_post_format() );
                else
                    if ($sf_impact_lite_show_full_sticky_post)
                        get_template_part('template-parts/content', 'sticky_full');
                    else
                        get_template_part('template-parts/excerpt', 'get_post_format');
			?>

		<?php endwhile; ?>
        </div>
		<?php the_posts_navigation(); ?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; 
   }
endif;
//Utility Functions
/*
* Check to see if the full post should be displayed or the excerpt
*/
if ( ! function_exists( 'sf_impact_lite_postContentFull' ) ) :
    function sf_impact_lite_postContentFull()
    {
     $full = TRUE;

    if (!is_search())
    {
     if (is_archive())
     {
    
        $full = ! get_theme_mod('sf_impact_lite_show_excerpt_archive_post', true);
     } 
      else if ((!is_single()  && !is_page()) )
     {
    
        $full = !get_theme_mod('sf_impact_lite_show_excerpt_blog_post', TRUE);
    
    
     }
    }
    else 
        $full = FALSE; // Not an option for search
     return $full;
    }
endif;
/*
* Get the base current URL
*/
if (!function_exists('sf_impact_lite_geturi')):

     function sf_impact_lite_geturi()
     {
        global $wp;
        return home_url(add_query_arg(array(),$wp->request)); 
     }
 endif;
 /*
 * Convert hex color to rgb
 * $hex = hex color
 */
if (!function_exists('sf_impact_lite_hex2rgb')):
    function sf_impact_lite_hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);
       return $rgb;
    }
endif;
/*
* Get RGBA style string
* $hex = hex color
* $opacity = opacity
*/
if (!function_exists('sf_impact_lite_rgbastyle')):
    function sf_impact_lite_rbgastyle($hex, $opacity)
    {
    
        $rgb = join(",", sf_impact_lite_hex2rgb($hex));
        $rgba = $rgb . "," . strval($opacity/100);
  
        return
        " background-color: $hex;
        background-color: rgba($rgba); ";
    }
endif;
/*
* For debugging only
*/
if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

/*
* Post Meta
*/



/**
 * Calls the class on the post edit screen to create custom meta values
 */
function call_sfly_post_meta() {
    new sfly_post_meta();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_sfly_post_meta' );
    add_action( 'load-post-new.php', 'call_sfly_post_meta' );
}

/** 
 * The Class.
 */
 if (!class_exists('sfly_post_meta')):
    class sfly_post_meta {

	    /**
	     * Hook into the appropriate actions when the class is constructed.
	     */
	    public function __construct() {
		    add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		    add_action( 'save_post', array( $this, 'save' ) );
            add_filter( 'admin_post_thumbnail_html', array($this, 'add_image_meta' ));
	    }

	    /**
	     * Adds the meta box container.
	     */
	    public function add_meta_box( $post_type ) {
                $post_types = array('post');     //limit meta box to certain post types
                if ( in_array( $post_type, $post_types )) {
		    add_meta_box(
			    'sfly_post_features'
			    ,__( 'Post Settings', 'sf-impact-lite' )
			    ,array( $this, 'render_meta_box_content' )
			    ,$post_type
			    ,'side'
			    ,'high'
		    );
                }
	    }

	    /**
	     * Save the meta when the post is saved.
	     *
	     * @param int $post_id The ID of the post being saved.
	     */
	    public function save( $post_id ) {
	
		    /*
		     * We need to verify this came from the our screen and with proper authorization,
		     * because save_post can be triggered at other times.
		     */

		    // Check if our nonce is set.
		    if ( ! isset( $_POST['sf_impact_lite_inner_custom_box_nonce'] ) )
            {
                write_log( 'invalid nonce');
			    return $post_id;
            }
     
      
            $this->updateCheckBox($post_id, "hide_featured_image");
       
 
		    $nonce = $_POST['sf_impact_lite_inner_custom_box_nonce'];

		    // Verify that the nonce is valid.
		    if ( ! wp_verify_nonce( $nonce, 'sf_impact_lite_inner_custom_box' ) )
            {
                write_log( 'invalid nonce');
			    return $post_id;
            }
		    // If this is an autosave, our form has not been submitted,
                    //     so we don't want to do anything.
		    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			    return $post_id;

		    // Check the user's permissions.
		    if ( 'page' == $_POST['post_type'] ) {
				    return $post_id;
	
		    } else {

			    if ( ! current_user_can( 'edit_post', $post_id ) )
				    return $post_id;
		    }
            $this->updateCheckbox($post_id, "post_hide_sidebar");
            $this->updateCheckbox($post_id, "post_show_in_slideshow");
	
	    }

        function add_image_meta( $content ) {
     
                global $post;
                if ($post->post_type === 'post') {
                    $text = __( 'Don\'t display image in post.', 'sf-impact-lite' );
      
                    $defvalue = !get_theme_mod('sf_impact_lite_post_featured', TRUE);
    
        
                    $meta = get_post_meta( $post->ID, "hide_featured_image", true );
        
                    if ($meta != NULL)
                        $value = get_post_meta( $post->ID, "hide_featured_image", true );
                    else 
                        $value = $defvalue;
     
                     $label = '<label for="hide_featured_image" class="selectit">
                        <input name="hide_featured_image" type="checkbox" id="hide_featured_image" ' . checked( $value, 1, false) .'> ' . $text .'
                        </label>';
                     $content .= $label;
                }
                return $content;
            }
        public function updateCheckbox($post_id, $id)
        {
           $value =  isset( $_POST[$id]) && $_POST[$id]  ? 1 : 0;
     

            update_post_meta( $post_id, esc_attr($id), $value ); //save value
        }
         public function createCheckbox($id, $label, $default = NULL)
         {
            global $post;
            if (!$default)
              $default = FALSE;
            $meta = esc_attr( get_post_meta( $post->ID, $id, true ) );
            $value = $meta != NULL ? $meta : $default;
 
            echo '<div><label for="' . $id . '" class="selectit"><input name="' . $id . '" type="checkbox" id="' . $id . '" value="' . $value . ' "'. checked( $value, 1, false) .'> ' . $label .'</label></div>';
	    }
        /**
	     * Render Meta Box content.
	     *
	     * @param WP_Post $post The post object.
	     */
	    public function render_meta_box_content( $post ) {
	
		    // Add an nonce field so we can check for it later.
		    wp_nonce_field( 'sf_impact_lite_inner_custom_box', 'sf_impact_lite_inner_custom_box_nonce' );
            $defaultval = !get_theme_mod('sf_impact_lite_post_sidebar', FALSE);
            $this->createCheckbox("post_hide_sidebar", "Hide Sidebar (Full Page)", $defaultval);
            $this->createCheckbox("post_show_in_slideshow", "Include in Slide Show", TRUE);

                    
	
	    }
    }
endif;
if (!class_exists('sf_impact_lite_CustomLinkThemes')):
{
    class sf_impact_lite_CustomLinkThemes {
/**
 * Load the available style templates. If a child theme exists,
 * load parent and child theme choices.
 */
        private $choices, $themename;
        const parentDir = 1, childDir = 2;
    
        public function __construct($themename) 
        {      
            $this->themename = $themename;  
            $this->loadAllThemeOptions();
        }  
    
        public function getCustomThemePath( $choice ) 
        {        
            return $this->choices[$choice]['uri'] . "/" . $choice . "-scheme.css";
        }
    
        public function getLinkThemesForCustomizer()
        {
            $result = array();
        
            foreach($this->choices as $choice) {
                $ucstring = ucfirst($choice['customizer']);
                $result[$choice['customizer']] = $ucstring;
            }
            return $result;   
        }
    
        private function getThemesFromFolder($dir, $folder) 
        {
            $themes = array();
        
            if( $dir === self::parentDir ) {
                $dir = get_template_directory();
                $uri = get_template_directory_uri();
            } elseif ( $dir === self::childDir ) {
                $dir = get_stylesheet_directory();
                $uri = get_stylesheet_directory_uri();
            } else {
                throw new \Exception ('Incorrect usage, should be const::parent or const::child');
            }
            if(is_dir( $dir )) {
                $files = scandir( $dir . $folder );
            
                //Strip out . and ..
                $files = array_diff( $files, array( ".",".." ) );

                foreach($files as $file) {
                    if(preg_match("/([a-zA-Z0-9]+)-scheme\.css/",$file,$string)) {
                    
                        $ucstring = ucfirst($string[1]);
                    
                        $themes[$string[1]] = array( 
                            'uri' => $uri . $folder,
                            'customizer' => $string[1],
                        );
                    }
                }
            }
        
            return $themes;     
    }
    
        private function loadAllThemeOptions()
        {
            $choices = $this->getThemesFromFolder( self::parentDir, "/style-parts" );
        
            if(( $styledir = get_stylesheet_directory() ) !== ( $themedir = get_template_directory() )) {
        	    $childChoices = $this->getThemesFromFolder( self::childDir, "/style-parts" );
        	
        	    $choices = array_merge(
        	        $choices,
        	        $childChoices
    	        );
            }
        
            $this->choices = $choices;        
        }
    }
}
endif;
/*
* Return number of stickys for given query
*/
if (!function_exists('sf_impact_lite_count_sticky')):
function sf_impact_lite_count_sticky($category = NULL)
{
    $args = array(
			
			'post__in' => get_option( 'sticky_posts' ),
			'showposts' => '3'
		);
    if ($category)
        $args['cat'] = $category;
    $the_query = new WP_Query( $args );

	$count = $the_query->post_count;
    return $count;
}
 endif; 
 if (!function_exists('sf_impact_lite_posts_by_category')):
     function sf_impact_lite_posts_by_category($category)
     {
         $stickycount = sf_impact_lite_count_sticky($category);
              $args	= array(
					            'post_type' => 'post',
					            'order' => 'DESC',
					            'orderby' => 'post_date',
                                'cat' => $category,
					        );
              $the_query = new WP_Query($args);
                         
               sf_impact_lite_posts($the_query, $stickycount);  
     }
 endif;

 function sf_impact_light_menu()
 {
        
    $menu_settings = array( 'theme_location' => 'primary',  
                                'link_before' => '<span class="menu-item-bg">', 
                                'container_id' => 'cssmenu',
                                'link_after' => '</span>', 
                                'menu_class' => 'nav-menu primary-menu fixed', 
                                'menu_id' => 'primary-menu' )?>                   
    <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
		    <button class="menu-toggle fa fa-ellipsis-h"></button>
		    <div>
                <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sf-impact-lite' ); ?></a>
            </div>
		    <?php wp_nav_menu( $menu_settings ); ?>
	    </nav>        
<?php }
 if (!function_exists('sf_impact_lite_get_url')):
function sf_impact_lite_get_url() {
    // preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) ;
        //return false;
        $pattern = '#(www\.|https?://)?[a-z0-9]+\.[a-z0-9]{2,4}\S*#i';
if (!preg_match_all($pattern, get_the_content(), $matches, PREG_PATTERN_ORDER))
    return false;

    return esc_url_raw( $matches[0][0]);
}
endif;

add_filter( 'the_content', 'sf_impact_format_content' );

function sf_impact_format_content( $content ) {

	/* Check if we're displaying a 'quote' post. */
	if ( has_post_format( 'quote' ) ) {

		/* Match any <blockquote> elements. */
		preg_match( '/<blockquote.*?>/', $content, $matches );

		/* If no <blockquote> elements were found, wrap the entire content in one. */
		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}
 
    if ( has_post_format( 'aside' ) && !is_singular() )
		$content .= ' <a href="' . get_permalink() . '">&#8734;</a>';



    if (has_post_format( 'chat'))
        return (sf_impact_lite_chat_content($content));

	return $content;
}
function sf_impact_lite_chat_content( $content ) {
	global $_post_format_chat_ids;

	/* If this is not a 'chat' post, return the content. */
	if ( !has_post_format( 'chat' ) )
		return $content;
       
	/* Set the global variable of speaker IDs to a new, empty array for this chat. */
	$_post_format_chat_ids = array();

	/* Allow the separator (separator for speaker/text) to be filtered. */
	$separator = apply_filters( 'my_post_format_chat_separator', ':' );

	/* Open the chat transcript div and give it a unique ID based on the post ID. */
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {

		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {

			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = sf_impact_lite_chat_row_id( $chat_author );

			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . $separator . '</cite></div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {

			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'my_post_format_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global 
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John" 
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class 
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function sf_impact_lite_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}
?>