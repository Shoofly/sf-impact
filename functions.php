<?php /**
 * sf_impact_theme1 functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 */


if ( ! function_exists( 'sf_impact_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sf_impact_setup() {


	load_theme_textdomain( 'sf-impact', get_template_directory() . '/languages' );


    //add blog page template
    add_filter( 'template_include', 'blog_template' );
    /*
    * Overwrite page with blog template for thumbnail grid when no post category
    */
    function blog_template( $template ) {
        global $post;
        $sf_impact_home_rp_categoryid = get_theme_mod('sf_impact_home_rp_categoryid', "");
        $sf_impact_thumbnail_more_page = get_theme_mod('sf_impact_thumbnail_more_page', '');
        if (is_page() && $post) //Only display on a page if the post exists
        { 
       
            if(( $post->ID == $sf_impact_thumbnail_more_page) && ($sf_impact_home_rp_categoryid == "0" || $sf_impact_home_rp_categoryid == ""))
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


     //defaults
    $sf_impact_demo_data = get_theme_mod("sf_impact_demo_data", TRUE);
    if ($sf_impact_demo_data)
    {
        $defaultpath =        get_template_directory_uri() . '/images/';
        $defaultlogo = $defaultpath . "logo.png"; 
 //       $defaultheader = $defaultpath . "impact.png";
        $defaultheadertype = "3";
  
        set_theme_mod('sf_impact_header_image', $defaultheader);
        set_theme_mod('sf_impact_logo_image', $defaultlogo);
        set_theme_mod('sf_impact_logo_location', 'image');
        set_theme_mod('sf_impact_home_header_type', $defaultheadertype);
        set_theme_mod('sf_impact_highlight_boxes', 2);
        set_theme_mod('sf_impact_highlight_header1', 'Up to 3 highlights');
        set_theme_mod('sf_impact_highlight_image1', $defaultpath . 'idea.png');
        set_theme_mod('sf_impact_highlight_text1', 'Create up to 3 highlight boxes!');
        set_theme_mod('sf_impact_highlight_link1', '#'); 
        set_theme_mod('sf_impact_highlight_header2', 'Home Page features');
        set_theme_mod('sf_impact_highlight_image2', $defaultpath . 'home.png');
        set_theme_mod('sf_impact_highlight_text2', 'Display an image or a slide show!');
        set_theme_mod('sf_impact_highlight_link2', '#'); 
        set_theme_mod('sf_impact_home_featured_highlights', true);
        set_theme_mod('sf_impact_demo_data', false);
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
 

        $themedir = get_template_directory_uri();
        
       
        $custom_style =  get_theme_mod('sf_impact_color_theme', "light") ;
        $linkTheme = new sf_impact_CustomLinkThemes( 'sf_impact' );
        
        wp_register_style('sf_impact_theme_styles', $themedir . '/styles/app.css', '1.0');
      
        wp_enqueue_style("sf_impact_theme_styles");
        
        ob_start();
        include( $linkTheme->getCustomThemePath($custom_style) );
        $custom_css = ob_get_clean();
        
        $custom_css .= '
            .foreground-color {
                background-color: '. get_theme_mod( 'sf_impact_content_background' ) .';   
            }
            
            .background-color {
                background-color: '. get_theme_mod( 'background_color' ) .';
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
   
    
           $sf_impact_home_header_type = get_theme_mod('sf_impact_home_header_type', "0");
            if ($sf_impact_home_header_type == "1")
            {
              
               add_action( 'wp_footer', 'sf_impact_slideshow_scripts');
            }
           wp_register_style( '_sf_impact_header_styles', $themedir . '/styles/home.css', array(), '1.0');
           wp_enqueue_style( '_sf_impact_header_styles' );
           if ($sf_impact_home_header_type == "1")
           {
                wp_register_style( 'flex_style', $themedir . '/flexslider/flexslider.css', array(), '2.5.0');
                wp_enqueue_style("flex_style");
                wp_register_script('flex_script', $themedir . '/flexslider/jquery.flexslider-min.js', array(), "2.5.0");
                wp_enqueue_script('flex_script');
  

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
/*require get_template_directory() . '/inc/imagesize-dropdown-custom-control.php';  //Image Size
require get_template_directory() . '/inc/category-dropdown-custom-control.php';     //Category
require get_template_directory() . '/inc/page-dropdown-custom-control.php';         //Page
require get_template_directory() . '/inc/arbitrary-custom-control.php';             //Label & Header Text, LInes
require get_template_directory() . '/inc/color-custom-control.php';                 //Color
require get_template_directory() . '/inc/number-custom-control.php';                //Number & Range
*/
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
require get_template_directory() . '/inc/functions-home.php';     //Home page functions
require get_template_directory() . '/inc/functions-header.php';   //Header functions
require get_template_directory() . '/inc/functions-utility.php';
require get_template_directory() . '/inc/functions-formats.php';
require get_template_directory() . '/inc/functions-custom-controls.php';

/*
* Post Meta
*/

/**
 * Calls the class on the post edit screen to create custom meta values
 */
/*function call_sfly_post_meta() {
    new sfly_post_meta();
}*/

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

?>
