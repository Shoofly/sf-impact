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
require get_template_directory() . '/inc/functions-social.php';     //Social Meida
require get_template_directory() . '/inc/functions-appearance.php'; //General appearance
require get_template_directory() . '/inc/functions-content.php';    //post type content
require get_template_directory() . '/inc/functions-util.php';       //utilities
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
    sf_impact_setDefaults();
     //settings moved here

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
          
        wp_register_style("sf_impact_theme_styles", "$themedir/styles/app.css", "1.0");
      
        wp_enqueue_style("sf_impact_theme_styles");     
   
 
        

        add_editor_style( "$themedir/styles/app.css" /*, "$themedir/style-parts/$custom_style-scheme.css"*/); 

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
                wp_register_script('flex_script', $themedir . '/flexslider/jquery.flexslider-min.js', array(), "2.5.0", true);
                wp_enqueue_script('flex_script');
                add_filter('wp_footer', 'sf_impact_slideshow_scripts');

           }
        }
        if (sf_impact_is_grid())
        {
            wp_register_script('thumbnail_grid_script', plugins_url() . '/thumbnail-grid/js/thumbnailgrid.js', true );
            wp_enqueue_script("thumbnail_grid_script");
        }

	  //  wp_enqueue_style( 'shoofly-style', get_stylesheet_uri() );
	    wp_enqueue_script( 'shoofly-navigation', get_template_directory_uri() . '/js/functions-min.js', array(), '20120206', true );
        wp_register_style('font_awesome', get_template_directory_uri() . "/font-awesome/css/font-awesome.min.css", '4.4');
        wp_enqueue_style('font_awesome');
    	wp_enqueue_script( 'shoofly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		    wp_enqueue_script( 'comment-reply' );
	    }
     
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
  
	    }

	    /**
	     * Adds the meta box container.
	     */
	    public function add_meta_box( $post_type ) {
            
                $post_types = array('post', 'page');     //limit meta box to certain post types
                if ( in_array( $post_type, $post_types )) {
                    if ($post_type == "post")
                        $title =  __( 'Post Settings', 'sf-impact' );
                    elseif ($post_type == "page")
                        $title =  __( 'Page Settings', 'sf-impact' );
		            add_meta_box(
			                'sfly_post_features'
			                , $title
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
         global $post;
		    // Check if our nonce is set.
		    if ( ! isset( $_POST['sf_impact_inner_custom_box_nonce'] ) )
            {
                write_log( 'invalid nonce');
			    return $post_id;
            }
     
 
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
     
             $posttype = get_post_type($post);
         
	        
         
              if ('post' == $posttype)
              {
                 if ( ! current_user_can( 'edit_posts', $post_id ) )
				    return $post_id;
                  $this->updateCheckbox($post_id, "post_hide_sidebar");
                  $this->updateCheckbox($post_id, "post_show_in_slideshow");
             
		      }
              else
                    if ( ! current_user_can( 'edit_pages', $post_id ) )
				    return $post_id;
            
		      $this->updateCheckBox($post_id, "show_featured_image");
 		  
	   }
 
        public function updateCheckbox($post_id, $id)
        {
            $value =  isset( $_POST[$id]) && $_POST[$id]  ? 1 : 0;
        
            update_post_meta( $post_id, esc_attr($id), $value ); //save value
        }
         public function createCheckbox($id, $label, $newpost = FALSE,  $default = NULL)
         {
            global $post;
            if (!$default)
              $default = FALSE;
            $meta = get_post_meta( $post->ID, $id, true ) ;
  
            $value = $newpost ? esc_attr($default) : esc_attr($meta);

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
             $posttype = get_post_type($post);
		    wp_nonce_field( 'sf_impact_inner_custom_box', 'sf_impact_inner_custom_box_nonce' );
            $newpost = is_edit_page('new');
            if ($posttype == "post")
            {
                $defaultval = !$sf_impact_Theme_Mods->getMod( 'sf_impact_post_sidebar');
                $this->createCheckbox("post_hide_sidebar", "Hide Sidebar (Full Page)", $newpost, $defaultval);
                $this->createCheckbox("post_show_in_slideshow", "Include in Slide Show", $newpost, TRUE);
            }
           
            if ($posttype === 'post' || $posttype=='page') {
                if ($posttype == 'post')
                {
                    $text = __( "Display featured image in post", 'sf-impact' );
                    $defvalue = $sf_impact_Theme_Mods->getMod( 'sf_impact_post_featured');
                }
                else
                {
                    $text = __( "Display featured image in page", 'sf-impact' );
                    $defvalue = $sf_impact_Theme_Mods->getMod( 'sf_impact_page_featured');
                }
               
               
                $this->createCheckbox("show_featured_image", $text, $newpost, $defvalue);
                
                
        	}
        }
    }
endif;
if (!function_exists('sf_impact_getCustomUrl')):
function sf_impact_getCustomUrl($url)
{
    global $post, $sf_impact_Theme_Mods;
      if (is_single()) {
           $sf_impact_post_header = $sf_impact_Theme_Mods->getMod('sf_impact_post_header');
            $sf_impact_post_featured = $sf_impact_Theme_Mods->getMod('sf_impact_post_featured');
        } elseif (is_page()) {
            $sf_impact_post_header = $sf_impact_Theme_Mods->getMod('sf_impact_page_header');
            $sf_impact_post_featured = $sf_impact_Theme_Mods->getMod('sf_impact_page_featured');  
        }        
        $meta = get_post_meta( $post->ID, 'show_featured_image'  ) ;
     
        if (( $sf_impact_post_header && $meta) )
        {
             $image_id = get_post_thumbnail_id();
             $image_atts = wp_get_attachment_image_src($image_id, "full", true);
             
             if (isset($image_atts) && $image_atts[1] >= HEADER_IMAGE_WIDTH ) {
                $url = $image_atts[0] ; //Replace the default header

             }
                   
        }
         return $url;
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
                die('Incorrect usage, should be const::parent or const::child');
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
if (!function_exists('sf_impact_setDefaults')):
   function sf_impact_setDefaults()
    {
        global $sf_impact_Theme_Mods;
        $sfimpact_demo_data = $sf_impact_Theme_Mods->getMod('sf_impact_demo_data', TRUE); //This is not really a setting, it's a switch. 
        if ($sfimpact_demo_data) {
           
            $defaultpath =        get_template_directory_uri() . '/images/';
            $defaultlogo = $defaultpath . "logo.png"; 

            $defaultheader = $defaultpath . "impact.png";
            $defaultheadertype = "3"; //This should be 2
           // $sf_impact_Theme_Mods->setDefault('header_textcolor','000099');      
         //   $sf_impact_Theme_Mods->setMod('sf_impact_header_image', $defaultheader); //this should not be set
         
            $sf_impact_Theme_Mods->setMod('sf_impact_logo_image', $defaultlogo);
            $sf_impact_Theme_Mods->setMod('sf_impact_logo_location', 'image');
            $sf_impact_Theme_Mods->setMod('sf_impact_home_header_type', $defaultheadertype);
            $sf_impact_Theme_Mods->setMod('sf_impact_highlight_style', 'T');
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
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_opacity', "0" );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_content_opacity', "100" );

        //Home settings
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_home_rp_categoryid', "" );
        
        //Header and Icon mods
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_icon_size', '1g' );
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
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_page_featured', false );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_post_sidebar', FALSE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_footer_text',    __( '© 2015 Shoofly Solutions', 'sf-impact' ));
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_home_sidebar', TRUE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_home_posts', TRUE );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_title', 'Recent Posts' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_more', 'More Recent Posts' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_type', 'post' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_post_category', 'post' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_thumbnail_more_page', '' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_posts', '4' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_image_size_name', 'thumbnail' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_image_height', '' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_grid_image_width', '' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_custom_footer_css', '' );
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_menu_location', 'above');
        $sf_impact_Theme_Mods->setDefault( 'sf_impact_header_stretch', true);
        $sf_impact_Theme_Mods->setDefault('sf_impact_social_above_menu', true);
    }
endif;
?>