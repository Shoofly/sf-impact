<?php /**
 * sf_impact_theme1 functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

define ('NOHEADER', 2);
define ('DEFAULTHEADER', 3);
define ('CUSTOMHEADER', 0);
define ('SLIDEHEADER', 1);
require get_template_directory() . '/inc/functions-social.php';

/**
 * Theme Mods.
 */
require get_template_directory() . '/inc/theme-mods.php';


if ( ! function_exists( 'sf_impact_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sf_impact_setup() {
    global $sf_impact_Theme_Mods;

	load_theme_textdomain( 'sf-impact', get_template_directory() . '/languages' );

    add_filter('wp_head', 'sf_impact_header_code');
    function sf_impact_header_code()
    {?>
        <meta charsett="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
       <?php 
    }

    //add blog page template
    add_filter( 'template_include', 'blog_template' ); //This will be called every time a template is loaded - I was wrong, it should always be called.
    /*
    * Overwrite page with blog template for thumbnail grid when no post category
    */
    function blog_template( $template ) {
        //This template will always be called when a page is loaded and will check below to see if this is the read more page before executing anything.  
        
        global $post, $sf_impact_Theme_Mods;
    
        $sf_impact_home_rp_categoryid = $sf_impact_Theme_Mods->getMod( 'sf_impact_home_rp_categoryid' );
        $sf_impact_thumbnail_more_page = $sf_impact_Theme_Mods->getMod( 'sf_impact_thumbnail_more_page' );
        //this conditional is the only thing that should be happening here.
        if (is_page() && $post && $post->ID == $sf_impact_thumbnail_more_page && ($sf_impact_home_rp_categoryid == "0" || $sf_impact_home_rp_categoryid == ""))
        {
           
            $template = get_template_directory() . '/inc/more-posts.php';
            if( file_exists( $template ) ) {
                    return $template;
            }

        }
        //moved settings out of here
     
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
		'primary' => esc_html__( 'Primary Menu', 'sf-impact' ),
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
        'chat',
		'gallery',
        'image',
		'video',
		'quote',
		'link',
        
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sf_impact_custom_background_args', array(
		'default-color' => '#3A3A3A',
		'default-image' => '',
	) ) );
    $args = array(
	    'width'         => 980,
	    'height'        => 60,
	    'default-image' => get_template_directory_uri() . '/images/impact.png',
    );
    add_theme_support( 'custom-header', $args );
    //add excerpt support for posts
     add_post_type_support( 'page', 'excerpt' );

     //settings moved here
        $sfimpact_demo_data = $sf_impact_Theme_Mods->getMod('sf_impact_demo_data', TRUE); //This is not really a setting, it's a switch. 
        if ($sfimpact_demo_data) {
           
            $defaultpath =        get_template_directory_uri() . '/images/';
            $defaultlogo = $defaultpath . "logo.png"; 

            $defaultheader = $defaultpath . "impact.png";
            $defaultheadertype = "3"; //This should be 2
            $sf_impact_Theme_Mods->setMod('header_textcolor','000099');      
         //   $sf_impact_Theme_Mods->setMod('sf_impact_header_image', $defaultheader); //this should not be set
         
            $sf_impact_Theme_Mods->setMod('sf_impact_logo_image', $defaultlogo);
            $sf_impact_Theme_Mods->setMod('sf_impact_logo_location', 'image');
            $sf_impact_Theme_Mods->setMod('sf_impact_home_header_type', $defaultheadertype);
          
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_boxes', 2);
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_header1', 'Up to 3 highlights');
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_image1', $defaultpath . 'flowers.png');
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_text1', 'Create up to 3 highlight boxes!');
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_link1', '#'); 
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_header2', 'Home Page features');
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_image2', $defaultpath . 'drop.png');
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_text2', 'Display an image or a slide show!');
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_link2', '#'); 
            $sf_impact_Theme_Mods->setMod('sf_impact_home_featured_highlights', true);
            $sf_impact_Theme_Mods->setMod('sf_impact_color_theme', 'light');
            $sf_impact_Theme_Mods->setMod('sf_impact_demo_data', FALSE);
          
        }
       
        //Color settings
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_background', "#5b5b5b" );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_content_background', "#F5F5F5" );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_opacity', 0 );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_content_opacity', 100 );

        //Home settings
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_home_rp_categoryid', "" );
        
        //Header and Icon mods
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_icon_size', 'lg' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_height', "" );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_width', "100%" );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_image', '' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_logo_location', 'image' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_home_header_type', '3' );
        
        //Slider mods
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_transition', 'fade' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_animspeed', '500' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_speed', '7000' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_automate', true );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_direction', 'horizontal');
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_navigation', FALSE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_navdirection', FALSE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_keyboard', true );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_mousewheel', false );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_pauseonhover', false );
        
        //Highlight box mods 
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_highlight_boxes', 0 );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_highlight_style', "L" );
        
        for($x=0; $x <= 3; ++$x)
        {
            $sf_impact_Theme_Mods->setDefault( 'sf_impact_highlight_image' . $x, '' );
            $sf_impact_Theme_Mods->setDefault( 'sf_impact_highlight_header' . $x, '' );
            $sf_impact_Theme_Mods->setDefault( 'sf_impact_highlight_text' . $x, '' );
            $sf_impact_Theme_Mods->setDefault( 'sf_impact_highlight_link' . $x, '#' );
        }
        
        
        //Grid mods
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_display', FALSE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_display_all', FALSE );
        
        //Slider mods
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_style', 'default' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_captions', TRUE ) ;
        
        //Thumbnail mods
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_slider_thumbnails', false );
         
        //Post mods   
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_show_full_sticky_post', true );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_show_excerpt_archive_post', true );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_show_excerpt_blog_post', TRUE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_post_featured', false );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_post_sidebar', FALSE );
        
        //Social settings
        $social_sites = sf_impact_social_media_array();
        $social_icons = sf_impact_social_icons_array();
 
        // any inputs that aren't empty are stored in $active_sites array
        $sf_impact_icon_size = $sf_impact_Theme_Mods->getMod( 'sf_impact_icon_size' );
        
        for ($i=0; $i < count($social_sites); ++$i) 
        {

            $social_site = $social_sites[$i];
            if( strlen( $sf_impact_Theme_Mods->getMod( $social_site ) ) > 0 ) {
                
                $active_sites[] = $social_site;
                $links[] = $sf_impact_Theme_Mods->getMod( $social_site );
                $icons[] = $social_icons[$i];
            }
        }     

}
endif; // sf_impact_setup
add_action( 'after_setup_theme', 'sf_impact_setup' );
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

add_action( 'tgmpa_register', 'sf_impact_plugins' );

if (!function_exists('sf_impact_plugins')):
/**
 * Sugested plugins 
 *
 * TGM Plugin Activation
 *
 */
    function sf_impact_plugins() {

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
                'page_title'                      => __( 'Install Required Plugins', 'sf-impact' ),
                'menu_title'                      => __( 'Install Plugins', 'sf-impact' ),
                'installing'                      => __( 'Installing Plugin: %s', 'sf-impact' ), // %s = plugin name.
                'oops'                            => __( 'Something went wrong with the plugin API.', 'sf-impact' ),
                'notice_can_install_required'     => __( 'This theme requires the following plugin: %1$s.',  'sf-impact' ), // %1$s = plugin name(s).
                'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'sf-impact' ), // %1$s = plugin name(s).
                'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'sf-impact'), // %1$s = plugin name(s).
                'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'sf-impact'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.',  'sf-impact'), // %1$s = plugin name(s).
                'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.',  'sf-impact'), // %1$s = plugin name(s).
                'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'sf-impact' ), // %1$s = plugin name(s).
                'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'sf-impact' ), // %1$s = plugin name(s).
                'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins',  'sf-impact'),
                'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'sf-impact' ),
                'return'                          => __( 'Return to Required Plugins Installer', 'sf-impact' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'sf-impact' ),
                'complete'                        => __( 'All plugins installed and activated successfully. %s', 'sf-impact' ), // %s = dashboard link.
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
 if (!function_exists('sf_impact_widgets_init')):
    function sf_impact_widgets_init() {
	    register_sidebar( array(
		    'name'          => esc_html__( 'Sidebar', 'sf-impact' ),
		    'id'            => 'sidebar-1',
		    'description'   => '',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
	    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );

	    register_sidebar( array(
		    'name' => __( 'Left Footer Sidebar', 'sf-impact' ),
		    'id' => 'sfly-footersidebar-left',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' => "</aside>",
			    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );
    	    register_sidebar( array(
		    'name' => __( 'Middle Footer Sidebar', 'sf-impact' ),
		    'id' => 'sfly-footersidebar-middle',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' => "</aside>",
		    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );
    	    register_sidebar( array(
		    'name' => __( 'Right Footer Sidebar', 'sf-impact' ),
		    'id' => 'sfly-footersidebar-right',
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget' => "</aside>",
			    'before_title' => '<div><h2 class="widget-title">',
		    'after_title' => '</h2></div>',
	    ) );

    }
endif;
add_action( 'widgets_init', 'sf_impact_widgets_init' );

/**
 * Enqueue scripts and styles.
 */

if (!function_exists('sf_impact_scripts')):
    function sf_impact_scripts() {
        global $sf_impact_Theme_Mods;

        $themedir = get_template_directory_uri();
        
       
        $custom_style =  $sf_impact_Theme_Mods->getMod( 'sf_impact_color_theme', 'light' ) ;

        $linkTheme = new sf_impact_CustomLinkThemes( 'sf_impact' );
        
        wp_register_style('sf_impact_theme_styles', $themedir . '/styles/app.css', '1.0');
      
        wp_enqueue_style("sf_impact_theme_styles");
        
        ob_start();
        include( $linkTheme->getCustomThemePath($custom_style) );
        $custom_css = ob_get_clean();
        
        $custom_css .= '
            .home-highlight-boxes .highlight-span h2 {
                color: #' . get_header_textcolor() . ';
            }
            .flexslider {
                min-height: ' . $sf_impact_Theme_Mods->getMod('sf_impact_header_height') . ';
            }';
         
        wp_add_inline_style( 'sf_impact_theme_styles', $custom_css );
        
        wp_register_style("sf_impact_theme_styles", "$themedir/styles/app.css", "1.0");
      
        wp_enqueue_style("sf_impact_theme_styles");
        

        add_editor_style( "$themedir/styles/app.css", "$themedir/style-parts/$custom_style-scheme.css"); 

        wp_enqueue_script('jquery');
        wp_enqueue_script('	jquery-ui-tooltip');
        if ( class_exists( 'bbPress' ) ) 
        {
            body_class( 'forum' );
            $slug = bbp_get_root_slug();
            $dir = site_url();
    
            $curpath = sf_impact_geturi();
            $bbspath = "$dir/$slug";
                  
            $cmp = stripos($curpath,  $bbspath); 
            if ( $cmp !== false)
            {
                    wp_register_style("sf_impact_bbspress", "$themedir/styles/bbspress.css", "1.0");
                    wp_enqueue_style("sf_impact_bbspress");
            }
        }
 
        $home = is_home() || is_front_page();
        if ($home)
        {
           $sf_impact_home_header_type = $sf_impact_Theme_Mods->getMod( 'sf_impact_home_header_type' );
           

           wp_register_style( '_sf_impact_header_styles', $themedir . '/styles/home.css', array(), '1.0');
           wp_enqueue_style( '_sf_impact_header_styles' );
           if ($sf_impact_home_header_type == "1")
           {
                wp_register_style( 'flex_style', $themedir . '/flexslider/flexslider.css', array(), '2.5.0');
                wp_enqueue_style("flex_style");
                wp_register_script('flex_script', $themedir . '/flexslider/jquery.flexslider-min.js', array(), "2.5.0");
                wp_enqueue_script('flex_script');
                add_filter('wp_footer', 'sf_impact_slideshow_scripts');

           }
        }
        if (sf_impact_is_grid())
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
add_action( 'wp_enqueue_scripts', 'sf_impact_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Default menu more in-line with regular menu
 */
require get_template_directory() . '/inc/default-menu.php';

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
* Woo Commerce
*/
add_filter('the_excerpt', array($GLOBALS['wp_embed'], 'autoembed'), 9);
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


add_action('woocommerce_before_main_content', 'sf_impact_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'sf_impact_wrapper_end', 10);
if (!function_exists('sf_impact_wrapper_start')):
    function sf_impact_wrapper_start() {
    echo '<div id="wrap" class="page-default">
	    <div id="primary" class="content-area ">
		    <main id="main" class="site-main" role="main">';
    }
endif;
			
if (!function_exists('sf_impact_wrapper_end')):			
            				      

function sf_impact_wrapper_end() {
  echo '		</main><!-- #main -->
	</div><!-- #primary -->';
}
endif;
/* 
* Restrict WP_Query to category on the home page
* Query - the query
*/
if (!function_exists('sf_impact_home_category')):                           
  function sf_impact_home_category( $query ) {
    global $sf_impact_Theme_Mods;
    
    $sf_impact_home_rp_categoryid = $sf_impact_Theme_Mods->getMod( 'sf_impact_home_rp_categoryid' );
    if ( $query->is_home() && $query->is_main_query() ) {
        $query->set( 'cat', $sf_impact_home_rp_categoryid );
    }
  }
       
 endif;  

//=========================================================Functions
/*
* Generate Style for the home page header 
*/

if (!function_exists('sf_impact_get_home_header_class')):
    function sf_impact_get_home_header_class()
    {
        global $sf_impact_Theme_Mods;
        $sf_impact_header_stretch = $sf_impact_Theme_Mods->getMod('sf_impact_header_stretch', true) ? TRUE : FALSE; 
        if ($sf_impact_header_stretch)
            $class = "sfly-img-stretch";
        else
            $class="sfly-img-fit";
  
        return $class;
    }
endif;
if (!function_exists('sf_impact_get_home_header_height')):
    function sf_impact_get_home_header_height()
    {
        global $sf_impact_Theme_Mods;
            $sf_impact_header_height = $sf_impact_Theme_Mods->getMod( 'sf_impact_header_height' );
            $style = "";
        
            if ($sf_impact_header_height)
                    $style .= "height:" . $sf_impact_header_height . "!important;";
            return $style;
    }
endif;
/* 
* Custom Styles
*/

/*
* Footer style for the home page if the header is a slideshow
*/

if (!function_exists('sf_impact_slideshow_scripts')):

    function sf_impact_slideshow_scripts()
    {
        global $sf_impact_Theme_Mods;     
        $sf_impact_slider_transition = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_transition' );
        $sf_impact_slider_animspeed = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_animspeed' );
        $sf_impact_slider_speed = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_speed' );
        $sf_impact_slider_automate = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_automate', true)  == TRUE ? 'true' : 'false';
        $sf_impact_slider_direction = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_direction' );
        $sf_impact_slider_navigation = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_navigation', FALSE) == TRUE ? "true" : "false";
        $sf_impact_slider_navdirection = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_navdirection', FALSE) == TRUE ? "true" : "false";
        $sf_impact_slider_keyboard = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_keyboard', true) == TRUE ? "true" : "false";
        $sf_impact_slider_mousewheel = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_mousewheel', FALSE) == TRUE ? "true" : "false";
        $sf_impact_slider_pauseonhover = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_pauseonhover', false) == TRUE ? "true" : "false";

         ?>
       	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider(
            {
                animation: "<?php echo $sf_impact_slider_transition;?>",              //String: Select your animation type, "fade" or "slide"
                slideDirection: "<?php echo $sf_impact_slider_direction; ?>",   //String: Select the sliding direction, "horizontal" or "vertical"
                slideshow: <?php echo $sf_impact_slider_automate; ?>,                //Boolean: Animate slider automatically
               useCSS: false,
                slideshowSpeed: <?php echo $sf_impact_slider_speed?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationDuration: <?php echo $sf_impact_slider_animspeed ?>,         //Integer: Set the speed of animations, in milliseconds
                directionNav: <?php echo $sf_impact_slider_navdirection ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
                controlNav: <?php echo $sf_impact_slider_navigation ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                keyboardNav: <?php echo $sf_impact_slider_keyboard?>,              //Boolean: Allow slider navigating via keyboard left/right keys
                mousewheel: <?php echo $sf_impact_slider_mousewheel?>,               //Boolean: Allow slider navigating via mousewheel
                prevText: "Previous",           //String: Set the text for the "previous" directionNav item
                nextText: "Next",               //String: Set the text for the "next" directionNav item
                pausePlay: false,               //Boolean: Create pause/play dynamic element
                pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
                playText: 'Play',               //String: Set the text for the "play" pausePlay item
                randomize: false,               //Boolean: Randomize slide order
                slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
                animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
                pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: <?php echo $sf_impact_slider_pauseonhover?>,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
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
if (!function_exists('sf_impact_homeheader')):
    function sf_impact_homeheader()
    {
        global $sf_impact_Theme_Mods;
        
        $top = TRUE;
      
  
        $sf_impact_header_image = $sf_impact_Theme_Mods->getMod( 'sf_impact_header_image' );
        $sf_impact_logo_location = $sf_impact_Theme_Mods->getMod( 'sf_impact_logo_location' );
        $sf_impact_home_header_type = $sf_impact_Theme_Mods->getMod( 'sf_impact_home_header_type' );
     
      
        if ($sf_impact_header_image && $sf_impact_logo_location == 'image')
            $top = FALSE;
  
        $hstyle = sf_impact_get_home_header_height();
 
        $wclass = sf_impact_get_home_header_class();
   
         if ($sf_impact_home_header_type == "1")
         {     
        
         
            sf_impact_get_slideshow($wclass, $hstyle);
         }
         else 
         {
             if ($sf_impact_header_image && $sf_impact_home_header_type == "0")
             {
                ?>
                <div class="header-containter-home ">
                    <img class="headerimg headerimg-home <?php echo $wclass?>" alt="header" style="<?php echo  $hstyle?>;" src="<?php echo $sf_impact_header_image?>"/>
                </div>           
                <?php 
                $output = "";
                $output = apply_filters('sf_impact_home_post_bar', $output);
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
if (!function_exists('sf_impact_get_thumbnailarray')):
    function sf_impact_get_thumbnailarray( )
    {
    global $sf_impact_Theme_Mods;      
        $type = get_theme_mod('sf_impact_grid_type', 'post');
        $gridwidth = "99%";
        $posts = get_theme_mod( 'sf_impact_grid_posts', '4');
        $height = get_theme_mod( 'sf_impact_grid_image_height',"" );
        $width= get_theme_mod( 'sf_impact_grid_image_width',"" );
         $cellwidth = get_theme_mod( 'sf_impact_grid_cell_width',  "" );
         $cellheight = get_theme_mod( 'sf_impact_grid_cell_height', "");
        $category = get_theme_mod( 'sf_impact_post_category', "");
        $imagesize = get_theme_mod( 'sf_impact_image_size_name', 'thumbnail');
        $captionwidth = $width;
        $arra = array('post_type' => $type, 'posts_per_page' => $posts,  'aligngrid' => 'autocenter',   'imagesize' => $imagesize, 'cellwidth' => $cellwidth, 'cellheight'=>$cellheight, 'captionwidth' => $captionwidth, 'ignore_sticky_posts' => 1);

        if ($height)
           $arra['height'] = $height;
        if ($width)
            $arra['width'] = $width;
   
         $arra = array('post_type' => $type, 'posts_per_page' => $posts,  'aligngrid' => 'autocenter',   'imagesize' => $imagesize, 'cellwidth' => $cellwidth, 'cellheight'=>$cellheight, 'captionwidth' => $captionwidth, 'ignore_sticky_posts' => 1);

           if ($height)
                $arra['height'] = $height;
            if ($width)
                $arra['width'] = $width;
        if ($category)
                $arra['cat']  = $category;
        if ($gridwidth)
            $arra['gridwidth'] = "99%";
        return ($arra);
    }
endif;
/*
* Get the URL of the post thumbnail 
*/
//Get thumbnail url
if (!function_exists('sf_impact_get_thumbnailurl')):
    function sf_impact_get_thumbnailurl()
    {
              global $sf_impact_Theme_Mods;      
        $category = get_theme_mod( 'sf_impact_post_category', "");
        $page = get_theme_mod('sf_impact_thumbnail_more_page', '');


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
if (!function_exists('sf_impact_get_highlightboxes')):
    function sf_impact_get_highlightboxes()
    {
        global $sf_impact_Theme_Mods;      
        $sf_impact_highlight_boxes = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_boxes', 0);
        $boxcount = intval( $sf_impact_highlight_boxes );
        if ($boxcount > 0) 
        { 
            $sf_impact_highlight_style = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_style' );
         
            for ($x = 0; $x <= 3; ++$x) 
            {
                ${'sf_impact_highlight_image' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_image' . $x, '');
                ${'sf_impact_highlight_header' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_header' . $x, '');
                ${'sf_impact_highlight_text' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_text' . $x, '');
                ${'sf_impact_highlight_link' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_link' . $x, '#');
            }

 
    
    
         ?>
    
            <div class="home-highlight-boxes fixed sfcenter">
                <?php
             
                $grid = 12/$boxcount;
                for ($x = 1; $x <= $boxcount; $x++)  :?>

                    <div class="highlight-<?php echo $boxcount ?>-col highlight-box highlight-box-<?php echo $boxcount?> grid_<?php echo $grid;?> sfchild">
                       <div class="highlight-box-container fixed highlight-box-<?php echo $x?>" >
                        <?php 
                        switch ($sf_impact_highlight_style)
                        {
                        default:
                        case ('L'):
                        {
                           if (${'sf_impact_highlight_image' . $x} != "")
                           {    sf_impact_getHightlightImg(${'sf_impact_highlight_image' . $x}, "highlight-left-img highlight-img-$x", ${"sf_impact_highlight_text$x"});     
                                $class="highlight-right-text highlight-text-$x";
                            }
                            else
                            {
                                    $class="highlight-full highlight-text-$x";
                            }
                            sf_impact_getHightlightText  (${"sf_impact_highlight_header$x"} ,  ${"sf_impact_highlight_text$x"}, $class); 
                        break;
                        }
                        case ("T"):
                        {
                            if (${'sf_impact_highlight_image' . $x} != "")
                            {
                                 sf_impact_getHightlightImg(${'sf_impact_highlight_image' . $x}, "highlight-top-img highlight-img-$x", ${"sf_impact_highlight_text$x"});
                            }
                             sf_impact_getHightlightText  (${"sf_impact_highlight_header$x"} ,  ${"sf_impact_highlight_text$x"}); 
                            break;
                         }        
                        case ("R"):
                        {
                                            
                           if (${'sf_impact_highlight_image' . $x} != "")
                           {        
                                $class="highlight-left-text highlight-text-$x";
                            }
                            else
                            {
                                    $class="highlight-full highlight-text-$x";
                            }
                             sf_impact_getHightlightText  (${"sf_impact_highlight_header$x"} ,  ${"sf_impact_highlight_text$x"}, $class); 
                            if (${'sf_impact_highlight_image' . $x} != "")
                            {        
                                 sf_impact_getHightlightImg(${'sf_impact_highlight_image' . $x}, "highlight-right-img highlight-img-$x", ${"sf_impact_highlight_text$x"});    
                            }
                           break;
                    
                        }
                        }
                        if (${'sf_impact_highlight_link' . $x} != "")
                            {?>
                              <div class="highlight-link"><a class="read-more btn" href="<?php echo ${'sf_impact_highlight_link' . $x};?>">more</a></div>   
                
 
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
if (!function_exists('sf_impact_getHightlightImg')):
    function sf_impact_getHightlightImg($imagename, $class, $alt)
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
if (!function_exists('sf_impact_getHightlightText')):
    function sf_impact_getHightlightText($header, $text, $class="highlight-full")
    {        
    ?>
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
 if (!function_exists('sf_impact_is_grid')):
    function sf_impact_is_grid()
    {
        global $sf_impact_Theme_Mods;
        $grid = FALSE;
        $sf_impact_grid_display = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_display', FALSE);
        $sf_impact_grid_display_all = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_display_all', FALSE);
      
           //Load script for thumbnail grid
         if (class_exists('sfly_thumbnailgrid'))
        {
            if (is_home() || is_front_page())
            {
                if ($sf_impact_grid_display)
                    $grid = true;
            }
            else
                if ($sf_impact_grid_display_all)
                    $grid = TRUE;
        }
       
        return $grid;
    }
endif;

/*
* Check to see if this is the home page or the front page (not the blog page)
* Returns Boolean
*/
if (!function_exists('sf_impact_is_home_page')):

    function sf_impact_is_home_page()
    {
       if ((is_home() || is_front_page()))
       {
           if ((isset($wp_query) && $wp_query -> is_posts_page))
                return FALSE;
          else
            return TRUE;
       }
        else
            return FALSE;
       
    }
endif;

if (!function_exists('sf_impact_slideshow_query')):
    function sf_impact_slideshow_query()
    {
        wp_reset_query();
            $args = array(
                'ignore_sticky_posts' => TRUE,
                'post_type' => 'post',
                'posts_per_page' => 5,
                'meta_query' => array(
                'relationship' => 'AND',
                array(
                    'key' => 'post_show_in_slideshow',
                    'value' => 1,
                ),

                array(
                    'key' => '_thumbnail_id',
                    'compare' => 'EXISTS'
                )
                ));
        $the_query =   new WP_Query($args);
     
        return $the_query;        
    }
endif;
/*
* HTML for the Home Page Slide Show
* $style - style for the slide show, height and width if not default
*/
if (!function_exists('sf_impact_get_slideshow')):
    function sf_impact_get_slideshow($the_query, $wclass, $hstyle)
    {
        global $sf_impact_Theme_Mods;
          $format =  $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_style' );
         
          $sf_impact_slider_captions = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_captions', TRUE) ;
          $istyle = "";
  
           if ($hstyle)
           {
                $fhstyle = "style=$hstyle";
              
           }
       
            ?>

         
    		<div class="flexslider" style="<?php echo $hstyle;?>"> 
		    <ul class="slides <?php echo $wclass?>" style="<?php echo $hstyle;?>">
                    <?php 
                     $sf_impact_slider_thumbnails = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_thumbnails', false) == TRUE ? "true" : "false";
                     while ( $the_query->have_posts() )  :$the_query->the_post();
                            $permalink = get_permalink();
                            $title = get_the_title();
                            $id = get_the_ID();
                            $image_id = get_post_thumbnail_id();
                            $image_atts = wp_get_attachment_image_src($image_id, "full", true);
                            $image_url = $image_atts[0] ;
                            $tnimage_atts = wp_get_attachment_image_src($image_id, "thumbnail", true);
                            $tnimage_url = $tnimage_atts[0];
                            if ($sf_impact_slider_thumbnails)
                                $datathumb = "data-thumb='$tnimage_url'";
                            else
                                $datathumb = "";
                            if ($image_url && strpos($image_url, 'default.png') == FALSE)
                            {
                              
                                $hid = "title" . $id;
                                ?>
                 	            <li <?php echo $datathumb?> <?php echo $fhstyle?> >
		    		            <a href="<?php echo $permalink ?>"><img src="<?php echo $image_url?>" alt="<?php echo $title?>" <?php echo $fhstyle; ?>/>
                                <?php if ($sf_impact_slider_captions==true) { ?>
		    		                <p class="flex-caption"><?php echo $title?></p>
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
 if (!function_exists('sf_impact_home_query')):
 function sf_impact_home_query()
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
    
        sf_impact_posts($the_query);

        wp_reset_postdata();
        
 }
 endif;
 /*
 * Display the blog posts on the home page or the blog page when the home page is a static page
 */
if (!function_exists('sf_impact_posts')):
    function sf_impact_posts($the_query, $stickycount = 0)
    {
        global $sf_impact_Theme_Mods;
        
        $full  = sf_impact_postContentFullPage();
    

        if ( $the_query->have_posts() ) :  ?>
        <div>
  		<?php /* Start the Loop */ ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
               <?php
                $current_post_index = $the_query->current_post ;   //Get the current index
                $full  = sf_impact_postContentFullPage();  //Check to see if the option to display excerpts is on or off
                $sf_impact_show_full_sticky_post = FALSE;  //Check to see if the sticky as full post option is on 
                if (is_sticky() && !$full)  //The sticky as full post is only valid when excerpts are enabled.
                   $sf_impact_show_full_sticky_post = ($sf_impact_Theme_Mods->getMod( 'sf_impact_show_full_sticky_post', true) && $current_post_index  == 0);      //Make sure that all sticky posts at the top display as full if this is set
                ?>      
			<?php
                if ($full)
				    get_template_part( 'template-parts/content', get_post_format() );
                else
                    if ($sf_impact_show_full_sticky_post)
                        get_template_part('template-parts/content', 'sticky_full');
                    else
                        get_template_part('template-parts/excerpt', get_post_format());
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
if ( ! function_exists( 'sf_impact_postContentFullPage' ) ) :
    function sf_impact_postContentFullPage()
    {
        global $sf_impact_Theme_Mods;
        $full = TRUE;

        if (!is_search()) {
            if (is_archive()) {
        
                $full = ! $sf_impact_Theme_Mods->getMod( 'sf_impact_show_excerpt_archive_post', true);
        
            } else {
                if ((!is_single()  && !is_page()) ) {
                    $full = !$sf_impact_Theme_Mods->getMod( 'sf_impact_show_excerpt_blog_post', TRUE);    
                }
            }
        } else { 
            $full = FALSE; // Not an option for search
        }
        
        return $full;
    }
endif;

/*
* Get the base current URL
*/
if (!function_exists('sf_impact_geturi')):

     function sf_impact_geturi()
     {
        global $wp;
        return home_url(add_query_arg(array(),$wp->request)); 
     }
 endif;
 /*
 * Convert hex color to rgb
 * $hex = hex color
 */
if (!function_exists('sf_impact_hex2rgb')):
    function sf_impact_hex2rgb($hex)
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
if (!function_exists('sf_impact_rgbastyle')):
    function sf_impact_rbgastyle($hex, $opacity)
    {
    
        $rgb = join(",", sf_impact_hex2rgb($hex));
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
			    ,__( 'Post Settings', 'sf-impact' )
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
		    if ( ! isset( $_POST['sf_impact_inner_custom_box_nonce'] ) )
            {
                write_log( 'invalid nonce');
			    return $post_id;
            }
     
      
            $this->updateCheckBox($post_id, "hide_featured_image");
       
 
		    $nonce = $_POST['sf_impact_inner_custom_box_nonce'];

		    // Verify that the nonce is valid.
		    if ( ! wp_verify_nonce( $nonce, 'sf_impact_inner_custom_box' ) )
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
     
                global $post, $sf_impact_Theme_Mods;
                if ($post->post_type === 'post') {
                    $text = __( 'Don\'t display image in post.', 'sf-impact' );
      
                    
                    $defvalue = !$sf_impact_Theme_Mods->getMod( 'sf_impact_post_featured', false);
                    $meta = get_post_meta( $post->ID, "hide_featured_image", true );
                    $value = $meta != NULL ? $meta : $defvalue;
                
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
            global $sf_impact_Theme_Mods;
		    // Add an nonce field so we can check for it later.
		    wp_nonce_field( 'sf_impact_inner_custom_box', 'sf_impact_inner_custom_box_nonce' );
            $defaultval = !$sf_impact_Theme_Mods->getMod( 'sf_impact_post_sidebar', FALSE);
            $this->createCheckbox("post_hide_sidebar", "Hide Sidebar (Full Page)", $defaultval);
            if (is_edit_page('new'))
               $this->createCheckbox("post_show_in_slideshow", "Include in Slide Show", TRUE);
            else
                $this->createCheckbox("post_show_in_slideshow", "Include in Slide Show");
                    
	
	    }
    }
endif;
if (!class_exists('sf_impact_CustomLinkThemes')):
{
    class sf_impact_CustomLinkThemes {
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
            return $this->choices[$choice]['dir'] . "/" . $choice . ".css.php";
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
                    if(preg_match("/([a-zA-Z0-9\-]+)\.css\.php/",$file,$string)) {
                    
                        $ucstring = str_replace( "-", " ", ucfirst( $string[1] ) );
                    
                        $themes[$string[1]] = array( 
                            'uri' => $uri . $folder,
                            'dir' => $dir . $folder,
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
if (!function_exists('sf_impact_count_sticky')):
function sf_impact_count_sticky($category = NULL)
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
 if (!function_exists('sf_impact_posts_by_category')):
     function sf_impact_posts_by_category($category)
     {
         $stickycount = sf_impact_count_sticky($category);
              $args	= array(
					            'post_type' => 'post',
					            'order' => 'DESC',
					            'orderby' => 'post_date',
                                'cat' => $category,
					        );
              $the_query = new WP_Query($args);
                         
               sf_impact_posts($the_query, $stickycount);  
     }
 endif;

 function sf_impact_menu()
 {
        
    $menu_settings = array( 'theme_location' => 'primary',  
                                'link_before' => '<span class="menu-link">', 
                                'container_id' => 'cssmenu',
                                'fallback_cb' => 'sf_impact_page_menu',
                                'link_after' => '</span>', 
                                'menu_class' => 'nav-menu primary-menu fixed', 
                                'menu_id' => 'primary-menu' )?>                   
    <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
		    <button class="menu-toggle fa fa-ellipsis-h"></button>
		    <div>
                <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sf-impact' ); ?></a>
            </div>
		    <?php wp_nav_menu( $menu_settings ); ?>
	    </nav>        
<?php }
 if (!function_exists('sf_impact_get_url')):
function sf_impact_get_url() {
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
        return (sf_impact_chat_content($content));

	return $content;
}
function sf_impact_chat_content( $content ) {
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
			$speaker_id = sf_impact_chat_row_id( $chat_author );

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
function sf_impact_chat_row_id( $chat_author ) {
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
 /*
* Main code for the header image
*/
if (!function_exists('sf_impact_header')):
    function sf_impact_header($sf_impact_home_header_type, $sf_impact_header_image, $sf_impact_logo_location, $the_slide_query = NULL)
    {
       // global $sf_impact_Theme_Mods;
        
        $top = TRUE;
 
/*        $sf_impact_header_image = $sf_impact_Theme_Mods->getMod( 'sf_impact_header_image' );
        $sf_impact_logo_location = $sf_impact_Theme_Mods->getMod( 'sf_impact_logo_location' );
        $sf_impact_home_header_type = $sf_impact_Theme_Mods->getMod( 'sf_impact_home_header_type' );
  */   
        if ($sf_impact_header_image && $sf_impact_logo_location == 'image')
            $top = FALSE;
            
       
         $wclass = sf_impact_get_home_header_class();
         $hstyle = sf_impact_get_home_header_height();
    
   
         if ($sf_impact_home_header_type == "1" && isset($the_slide_query))
         {     
          
            sf_impact_get_slideshow($the_slide_query, $wclass, $hstyle);
         }
         else 
         {
             if ($sf_impact_header_image && $sf_impact_home_header_type == "0")
             {
                ?>

                <img class="headerimg headerimg-home" alt="header" style="<?php echo  $hstyle?>;" src="<?php echo $sf_impact_header_image?>"/>
           
                <?php 
                $output = "";
                $output = apply_filters('sf_impact_home_post_bar', $output);
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
/**
 * is_edit_page 
 * function to check if the current page is a post edit page
 * 
 * @author Ohad Raz <admin@bainternet.info>
 * 
 * @param  string  $new_edit what page to check for accepts new - new post page ,edit - edit post page, null for either
 * @return boolean
 */
if (!function_exists('is_edit_page')):
function is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}
endif;
?>