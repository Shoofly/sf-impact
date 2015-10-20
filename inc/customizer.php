<?php
/**
 * Theme Customizer.
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */ ?>
<?php

 if (!class_exists('sf_impact_Customize')):
 class sf_impact_Customize {
    private $customStylesObj;
     function __construct()
     {
         global $sf_impact_Theme_Mods;
         
        //Private call loads custom CSS settings.
        require(get_stylesheet_directory() . "/inc/functions-colortheme-current.php");
        $this->customStylesObj =  new sf_impact_CurrentCustomColorTheme( $sf_impact_Theme_Mods->getMod('sf_impact_color_theme') ) ;

                   
        // Setup the Theme Customizer settings and controls...
        add_action( 'customize_register' , array( $this , 'sf_impact_customize_register' ) );

        // Output custom CSS to live site
        add_action( 'wp_head' , array( $this, 'sf_impact_header_output' ) );
        add_action( 'wp_footer', array($this, 'sf_impact_footer_output'));
        // Enqueue live preview javascript in Theme Customizer admin screen
        add_action( 'customize_preview_init' , array ( $this , 'sf_impact_customize_preview_js' ) );

    }

    
    public function  sf_impact_customize_register( $wp_customize ) {
     
        global $sf_impact_Theme_Mods;
      
   
        $wp_customize->add_setting( 'sf_impact_demo_data', 
                array(
                    'default' => true,
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
       
       $wp_customize->add_panel( 'sf_impact_panel_home', array(
            'title' =>  __('Home Page Options', 'sf-impact'),
            'capability' => 'edit_theme_options',
            'description' =>  __('Customize Theme Options.', 'sf-impact'),
            'priority' => 5,
      
          ));
               $wp_customize->add_panel( 'sf_impact_panel_post', array(
            'title' =>  __('Post & Page Options', 'sf-impact'),
            'capability' => 'edit_theme_options',
            'description' =>  __('Customize Theme Options.', 'sf-impact'),
            'priority' => 6,
      
          ));
          $this->sf_impact_generalOptions($wp_customize);
          $this->sf_impact_homePageOptions($wp_customize);
          $this->sf_impact_postOptions($wp_customize);
          $this->sf_impact_pageOptions($wp_customize);
          $this->sf_impact_thumbnailGridOptions($wp_customize);
          $this->sf_impact_sliderOptions($wp_customize);
          $this->sf_impact_socialMediaOptions($wp_customize);
          $this->sf_impact_highlightSettings($wp_customize);
          $this->sf_impact_editorDefaults($wp_customize);
          $this->sf_impact_customCSS($wp_customize);
            //Setting and control or the Logo Image
  

            $wp_customize->add_setting( 'sf_impact_logo_image', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_logo_image'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_image'
                ) 
            );      
       
            $wp_customize->add_control( new WP_Customize_Image_Control(
   
                $wp_customize, 
                'sf_impact_logo_image', 
                array(
                'label' => __( 'Logo', 'sf-impact' ), 
                'section' => 'title_tagline', 
                'settings' => 'sf_impact_logo_image', 
                'priority' => 10, 
                ) 
            ) );

            //Setting for Logo or title location above or on image (if there is an image)               
            $wp_customize->add_setting( 'sf_impact_logo_location', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_logo_location'), 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_select'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control ( //TODO Not Working!
   
                $wp_customize, 
                'sf_impact_logo_location', 
                array(
                'label' => __( 'Where should the logo or site title displayed?', 'sf-impact' ), 
                'section' => 'title_tagline', 
                'settings' => 'sf_impact_logo_location', 
                'priority' => 10, 
                'type'     => 'radio',
		    'choices'  => array(
			    'image'  => __('On top of header images', 'sf-impact'),
			    'top' => __('Above header images', 'sf-impact'),
                )
                ) 
            ) );   
        $wp_customize->add_setting( 'sf_impact_color_theme',
            array(
    	        'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_color_theme'),
    	        'type' 			=> 'theme_mod',
    	        'capability' 	=> 'edit_theme_options',
    	        'transport' 	=> 'postMessage',
                'sanitize_callback' => 'sf_impact_sanitize_select',
    	    )
    	);

        $choices = new sf_impact_CustomColorThemes( 'sf-impact' );

        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize, 
            'sf_impact_color_theme', 
            array(
                'label' => __( 'Color theme', 'sf-impact' ),
                'description' => __('Select a preset color theme.  This changes the default background color. Your custom background color will not be changed. ', 'sf-impact'),
                'section' => 'colors', 
                'settings' => 'sf_impact_color_theme', 
                'priority' => 1, 
                'type' => 'select',
                'choices' => $choices->getLinkThemesForCustomizer(),
            )
        ) );   
        $wp_customize->add_setting( 'sf_impact_header_opacity', 
            array(
               'default' => 0,//$sf_impact_Theme_Mods->getDefault('sf_impact_header_opacity', 0),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_number_range'
            ) 
        );      
        $wp_customize->add_control( new Number_Custom_Control (
                $wp_customize, 
            'sf_impact_header_opacity', 
            array(
            'type' => 'number',
            'label' => __( 'Site Header Background Opacity', 'sf-impact' ), 
            'description' => __('The background opacity for area above the header image & content', 'sf-impact'), 
            'section' => 'colors', 
            'settings' => 'sf_impact_header_opacity', 
            'min' => '0',
            'max' => '100',
            'priority' => 10, 
           
            ) 
        ) );  
        $wp_customize->add_setting( 'sf_impact_header_background', 
            array(
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_header_background'),
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options', 
            'transport' => 'refresh', 
            'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );      
        $wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'sf_impact_header_background', 
	    array(
		    'label'      => __( 'Site Header Background Color', 'sf-impact' ),
            'descriptin' => __( ' The background color for the area above the header and content. ', 'sf-impact'),
		    'section'    => 'colors',
		    'settings'   => 'sf_impact_header_background',
	    ) ) 
        );
      $wp_customize->add_setting( 'sf_impact_content_opacity', 
            array(
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_content_opacity'),
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options', 
            'transport' => 'refresh', 
            'sanitize_callback' => 'sf_impact_sanitize_number_range'
            ) 
        );      
        $wp_customize->add_control( new Number_Custom_Control (
                $wp_customize, 
            'sf_impact_content_opacity', 
            array(
            'type' => 'number',
            'label' => __( 'Content Background Opacity', 'sf-impact' ), 
            'description' => __('The background color opacity for site content', 'sf-impact'),
            'section' => 'colors', 
            'settings' => 'sf_impact_content_opacity', 
            'min' => '0',
            'max' => '100',
               
            'priority' => 10, 
           
            ) 
        ) );  
        $wp_customize->add_setting( 'sf_impact_content_background', 
            array(
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_content_background'),
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options', 
            'transport' => 'refresh', 
            'sanitize_callback' => 'sanitize_hex_color',
            ) 
        );      
        $wp_customize->add_control( 
		    new WP_Customize_Color_Control( 
			    $wp_customize, 
			    'sf_impact_content_background', 
			    array(
		            
				    'label'      => __( 'Content Background Color', 'sf-impact' ),
                    'description' => __('The background color for site content', 'sf-impact'),
				    'section'    => 'colors',
				    'settings'   => 'sf_impact_content_background',
			    ) 
	    	) 
        );    
        
        $customStyles = $this->customStylesObj->getThemeSettings();
        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
       $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->default = $sf_impact_Theme_Mods->getDefault('sf_impact_header_textcolor');
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->default   = $customStyles['backgroundColor'];
        
    }
    function sf_impact_generalOptions($wp_customize)
    {
        global $sf_impact_Theme_Mods;
            $wp_customize->add_section( 'sf_impact_general_options', 
                array(
                'title' => __( 'General Theme Options', 'sf-impact' ), 
                'priority' => 3, 
                'capability' => 'edit_theme_options',
                'description' => __('Genearal Theme Settings.', 'sf-impact'), //Descriptive tooltip
                //'panel' => 'sf_impact_panel',
                ) 
            );
           
           
 

            //Setting for Logo or title location above or on image (if there is an image)               
            $wp_customize->add_setting( 'sf_impact_menu_location', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_menu_location'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_select'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control ( //TODO Not Working!
   
                $wp_customize, 
                'sf_impact_menu_location', 
                array(
                'label' => __( 'Where should the menu be displayed?', 'sf-impact' ), 
                'section' => 'sf_impact_general_options', 
                'settings' => 'sf_impact_menu_location', 
                'priority' => 10, 
                'type'     => 'radio',
		    'choices'  => array(
			    'above'  => __('Above header image', 'sf-impact'),
			    'below' => __('Below header images', 'sf-impact'),
                )
                ) 
            ) );   

            //Setting and control for footer text
            $data = __( '© 2015 Shoofly Solutions', 'sf-impact' );
            $wp_customize->add_setting( 'sf_impact_footer_text', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_footer_text'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'esc_html',
                ) 
            );      
 
            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_footer_text', 
                array(
                'label' => __( 'What should display in the footer?', 'sf-impact' ), 
                'section' => 'sf_impact_general_options', 
                'settings' => 'sf_impact_footer_text', 
                'priority' => 10, 
           
                ) 
            ));
  
 
          
    }
function sf_impact_pageOptions($wp_customize)
{
 
    global $sf_impact_Theme_Mods;
               $wp_customize->add_section( 'sf_impact_page_options', 
                array(
                'title' => __( 'Page Options', 'sf-impact' ), 
                'priority' => 2, 
                'capability' => 'edit_theme_options',
                'description' => __('Custom page settings.', 'sf-impact'), //Descriptive tooltip
                'panel' => 'sf_impact_panel_post',
                ) 
            );
 
         $wp_customize->add_setting( "pagelabel6", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

             $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "pagelabel6",
                    array('type' => "h3",  'label' => __('Custom Page Header Images', 'sf-impact'), 'section' => 'sf_impact_page_options',  'settings' => "pagelabel6", 'priority' => 10, ) ) );
            $wp_customize->add_setting( "pagelabel5", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

             $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "pagelabel5",
                    array('type' => "text", 'style' => 'font-style:italic;',  'label' => __('If a post has the display featured image option selected, you can elect to display these images in the header or above the post by toggling this option.', 'sf-impact'), 'section' => 'sf_impact_page_options',  'settings' => "pagelabel5", 'priority' => 10, ) ) );
            //Setting to featured image on pages
            $wp_customize->add_setting( 'sf_impact_page_header', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_page_header'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
                   
            $wp_customize->add_control( 'sf_impact_page_header', array(
                'settings' => 'sf_impact_page_header',
                'label'    => __( 'Display the featured image as the header on pages', 'sf-impact'), 
              
                'section'  => 'sf_impact_page_options',
                'priority' => 10,
                'type'     => 'checkbox',
            ) );    
}
   function sf_impact_postOptions($wp_customize)
    {
        global $sf_impact_Theme_Mods;
            $wp_customize->add_section( 'sf_impact_post_options', 
                array(
                'title' => __( 'Post Options', 'sf-impact' ), 
                'priority' => 1, 
                'capability' => 'edit_theme_options',
                'description' => __('Custom post settings.', 'sf-impact'), //Descriptive tooltip
                'panel' => 'sf_impact_panel_post',
                ) 
            );
           
            $wp_customize->add_setting( "postlabel1", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

             $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel1",
                    array('type' => "h3",  'label' =>__('Post Settings', 'sf-impact'), 'section' => 'sf_impact_post_options',  'settings' => "postlabel1", 'priority' => 10, ) ) );
 
           //Setting to show author
            $wp_customize->add_setting( 'sf_impact_show_author', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_show_author'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox',
                ) 
            );                  
            $wp_customize->add_control( 'sf_impact_show_author', array(
                'settings' => 'sf_impact_show_author',
                'label'    => __( 'Display author information on posts', 'sf-impact'),
                'section'  => 'sf_impact_post_options',
                'priority' => 10,
                'type'     => 'checkbox',
            ) ); 

          
                       $wp_customize->add_setting( "postlabel6", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

             $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel6",
                    array('type' => "h3",  'label' => __('Custom Post Header Images', 'sf-impact'), 'section' => 'sf_impact_post_options',  'settings' => "postlabel6", 'priority' => 10, ) ) );
            $wp_customize->add_setting( "postlabel5", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

             $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel5",
                    array('type' => "text", 'style' => 'font-style:italic;',  'label' => __('When you select to display the featured header on a post, you can elect to have it display in place of the header instead of above above the post & below the header.', 'sf-impact'), 'section' => 'sf_impact_post_options',  'settings' => "postlabel5", 'priority' => 10, ) ) );
            //Setting to featured image on posts
            $wp_customize->add_setting( 'sf_impact_post_header', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_post_header'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
                   
            $wp_customize->add_control( 'sf_impact_post_header', array(
                'settings' => 'sf_impact_post_header',
                'label'    => __( 'Display the featured image as the header on posts', 'sf-impact'), 
                'section'  => 'sf_impact_post_options',
                'priority' => 10,
                'type'     => 'checkbox',
            ) );
                                   $wp_customize->add_setting( "postlabel2", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

                $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel2",
                    array('type' => "h3",   'label' => __('Post Lists', 'sf-impact'), 'section' => 'sf_impact_post_options',  'settings' => "postlabel2", 'priority' => 10, ) ) );
 
 //'style'="font-style:italic"
            //Setting to show thumbnail excerpts
            $wp_customize->add_setting( 'sf_impact_show_thumbnail_excerpt', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_show_thumbnail_excerpt'), 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox',
                ) 
            );      
            $wp_customize->add_control( 'sf_impact_show_thumbnail_excerpt', array(
                'settings' => 'sf_impact_show_thumbnail_excerpt',
                'label'    => __( 'Display the thumbnail on excerpts', 'sf-impact'),
                'section'  => 'sf_impact_post_options',
                'priority' => 10,
                'type'     => 'checkbox',
            ) );
        
 
          
            //Setting to show full posts or excerpts on archive pages
            $wp_customize->add_setting( 'sf_impact_show_excerpt_archive_post', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_show_excerpt_archive_post'), 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox',
                ) 
            );      
            
            $wp_customize->add_control( 'sf_impact_show_excerpt_archive_post', array(
             
                'label'    => __( 'Display excerpts on archive pages', 'sf-impact'),
                'section'  => 'sf_impact_post_options',
                            'priority' => 10,
                'type'     => 'checkbox',
            ) );
            //Setting to show full page or excerpts on blog pages
            $wp_customize->add_setting( 'sf_impact_show_excerpt_blog_post', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_show_excerpt_blog_post'),  
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
            
            $wp_customize->add_control( 'sf_impact_show_excerpt_blog_post', array(
                'settings' => 'sf_impact_show_excerpt_blog_post',
                'label'    => __( 'Display excerpts on the blog/home pages', 'sf-impact'),
                'section'  => 'sf_impact_post_options',
                            'priority' => 10,
                'type'     => 'checkbox',
            ) );

            $wp_customize->add_setting( "postlabel9", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

                $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel9",
                    array('type' => "h3",   'label' => __('Custom Post Listing Sticky', 'sf-impact'), 'section' => 'sf_impact_post_options',  'settings' => "postlabel9", 'priority' => 10, ) ) );
   
                                    $wp_customize->add_setting( "postlabel8", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

                $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel8",
                    array('type' => "text", 'style' => 'font-style:italic;',   'label' => __('You can use a sticky post as a header for your post listings when the listing displays excerpts.', 'sf-impact'), 'section' => 'sf_impact_post_options',  'settings' => "postlabel8", 'priority' => 10, ) ) );
                //Setting to show full posts or excerpts for sticky posts
            $wp_customize->add_setting( 'sf_impact_show_full_sticky_post', 
                array(
                 'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_show_full_sticky_post'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox',
                ) 
            );      
            
            $wp_customize->add_control( 'sf_impact_show_full_sticky_post', array(
                'settings' => 'sf_impact_show_full_sticky_post',
                'label'    => __( 'Display first sticky post as full post', 'sf-impact'), 
                'description' => __("", 'sf-impact'),
                'section'  => 'sf_impact_post_options',
                            'priority' => 10,
                'type'     => 'checkbox',
            ) );   
          
    }  
    function sf_impact_thumbnailGridOptions($wp_customize)
    {
        global $sf_impact_Theme_Mods;
        //Thumbnail Grid Options
            $wp_customize->add_section( 'sf_impact_grid_options', 
            array(
                'title' => __( 'Thumbnail Grid Options', 'sf-impact' ), 
                'priority' => 6, 
                'capability' => 'edit_theme_options',
                'description' => __('Customize a thumbnail grid that displays below the header (This feature requires the Featured Image Thumbnail Grid Plugin)', 'sf-impact'), //Descriptive tooltip
                 //'panel' => 'sf_impact_panel',
                ) 
            ); 
           if (class_exists('sfly_thumbnailgrid'))
           {
                //Display Grid on HOme Page
                $wp_customize->add_setting( 'sf_impact_grid_display', 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_display'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                    ) 
                );      
 
                $wp_customize->add_control( 'sf_impact_grid_display', array(
                    'settings' => 'sf_impact_grid_display',
                    'label'    => __( 'Display the thumbnail grid on the home page / front page.' , 'sf-impact'),
                    'section'  => 'sf_impact_grid_options',
                                'priority' => 10,
                    'type'     => 'checkbox',
                ) );
                //Display Grid on all pages
                $wp_customize->add_setting( 'sf_impact_grid_display_all', 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_display_all'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                    ) 
                );      
 
                $wp_customize->add_control( 'sf_impact_grid_display_all', array(
                    'settings' => 'sf_impact_grid_display_all',
                    'label'    => __( 'Display the thumbnail grid on all pages (not including the home page/ front page)' , 'sf-impact'),
                    'section'  => 'sf_impact_grid_options',
                                'priority' => 10,
                    'type'     => 'checkbox',
                ) );
                //Title for the Grid 
                    $wp_customize->add_setting( 'sf_impact_grid_title', 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_title'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'esc_textarea'
                    ) 
                );      
            
     
                $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    'sf_impact_grid_title', 
                    array(
                    'label' => __( 'The title of the grid area', 'sf-impact'), 
                    'description' => __("You can leave this blank if you don't want to display a title.", 'sf-impact' ), 
                    'section' => 'sf_impact_grid_options', 
                    'settings' => 'sf_impact_grid_title', 
                    'priority' => 10, 
           
                    ) 
                ) );
                //Text to click to full category page
                    $wp_customize->add_setting( 'sf_impact_grid_more', 
                    array(
                     'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_more'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'esc_textarea'
                    ) 
                );      
            
     
                $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    'sf_impact_grid_more', 
                    array(
                    'label' => __( "The text for the link at the bottom of the grid.", 'sf-impact'),
                    'description' => __("This link will display 'more' posts depending on the grid. You can leave this blank if you don't want to display a link.", 'sf-impact' ), 
                    'section' => 'sf_impact_grid_options', 
                    'settings' => 'sf_impact_grid_more', 
                    'priority' => 10, 
           
                    ) 
                ) );
             
                //Text to display thumbnails for posts or pages
                $wp_customize->add_setting( 'sf_impact_grid_type', 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_type'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_select'
                    ) 
                );      
            
     
            $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    'sf_impact_grid_type', 
                    array(
                    'label' => __( 'Display featured images for posts or pages in the grid', 'sf-impact' ), 
                    'description' => __( 'The page option could be used to create an image menu for your site. Categories can be enabled on pages using a plugin. ', 'sf-impact'),
                    'section' => 'sf_impact_grid_options', 
                    'settings' => 'sf_impact_grid_type', 
                    'priority' => 10, 
                    'type'     => 'radio',
		        'choices'  => array(
			        'post'  => __('Post', 'sf-impact'),
			        'page' => __('Page', 'sf-impact'),
                    )
                    ) 
                ) );
                //Category for the grid
                $wp_customize->add_setting( 'sf_impact_post_category', array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_post_category'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_category'
                ) );
                $wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 'sf_impact_post_category', array(
                    'label'=> __('Thumbnail category', 'sf-impact'),
                    'description'   => __( 'Display thumbnails for a selected category in the grid section or choose all', 'sf-impact' ),                'section' => 'sf_impact_grid_options',
                    'settings'   => 'sf_impact_post_category',
                    'priority' => 10
                ) ) );
 
                //Page to link to if All is selected - Will display standard 'blog' page
                $wp_customize->add_setting( 'sf_impact_thumbnail_more_page', array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_thumbnail_more_page'),
                     'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_dropdown_pages'
                ) );
                $wp_customize->add_control( new Page_Dropdown_Custom_Control( $wp_customize, 'sf_impact_thumbnail_more_page', array(
                    'label'   => __( 'Select a page for the link if "All" was selected', 'sf-impact' ), 
                    'description' => __('You should create a blank page where posts will be displayed. This page is similar to a Blog page', 'sf-impact'),
                    'section' => 'sf_impact_grid_options',
                    'settings'   => 'sf_impact_thumbnail_more_page',
                    'priority' => 10
                ) ) );
                //Number of thumbnails to display
                $wp_customize->add_setting( 'sf_impact_grid_posts', 
                        array(
                        'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_posts'),
                        'type' => 'theme_mod', 
                        'capability' => 'edit_theme_options', 
                        'transport' => 'refresh', 
                        'sanitize_callback' => 'sf_impact_sanitize_number_absint'
                        ) 
                    );      
                    $wp_customize->add_control( new Number_Custom_Control (
                    $wp_customize, 
     
                        'sf_impact_grid_posts', 
                        array(
                        'label' => __( 'Number of thumbnails to display', 'sf-impact' ), 
                        'description' => __( 'Enter the maximum number of items to display in the grid section', 'sf-impact'),
                        'section' => 'sf_impact_grid_options', 
                        'settings' => 'sf_impact_grid_posts', 
                        'priority' => 10, 
                        )
                    ) );
                //Wordpress Image Size
                $wp_customize->add_setting( 'sf_impact_image_size_name', array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_image_size_name'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sf_impact_sanitize_select'
                ) );
                $wp_customize->add_control( new ImageSize_Dropdown_Custom_Control( $wp_customize, 'sf_impact_image_size_name', array              (
                    'label'   => __( 'Grid image size', 'sf-impact' ), 
                    'description' => __('selects the wordpress image used in the grid. It does not effect the width & height which is set below', 'sf-impact'),
                    'section' => 'sf_impact_grid_options',
                    'settings'   => 'sf_impact_image_size_name',
                    'priority' => 10
                ) ) );
                //Image Height
                $wp_customize->add_setting( 'sf_impact_grid_image_height', 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_image_height'),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sanitize_text_field'
                    ) 
                );      
     
                $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    'sf_impact_grid_image_height', 
                    array(
                    'label' => __( 'Thumbnail height', 'sf-impact'),
                    'description' => __('If not default (usually 150px) enter a measurement (px, %, em) or auto', 'sf-impact' ), 
                    'section' => 'sf_impact_grid_options', 
                    'settings' => 'sf_impact_grid_image_height', 
                    'priority' => 10, 
           
                    ) 
                ) );
                //Image Width
                $wp_customize->add_setting( 'sf_impact_grid_image_width', 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_grid_image_width'), 
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sanitize_text_field'
                    ) 
                );      
                $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    'sf_impact_grid_image_width', 
                    array(
                    'label' => __( 'Thumbnail width', 'sf-impact'), 
                    'description' => __('If not default (usually 150px) enter a measurement (px, %, em) or auto', 'sf-impact' ), 
                    'section' => 'sf_impact_grid_options', 
                    'settings' => 'sf_impact_grid_image_width', 
                    'priority' => 10, 
           
                    ) 
                ) );       
           }
           else
           {
                $wp_customize->add_setting( "gridlabel", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

                $wp_customize->add_control(
                new Arbitrary_Custom_Control(
                    $wp_customize,  "gridlabel",
                    array(
                        'type' => "h3",  'label' => __('The Featured Image Thumbnail Plugin is required to use this feature.', 'sf-impact'), 'section' => 'sf_impact_grid_options', 
                        'settings' => "gridlabel", 'priority' => 10, 
                    )
                )
            );

           }
    }
    function sf_impact_homePageOptions($wp_customize)
    {
        global $sf_impact_Theme_Mods;
                //Home Page Settings
            $wp_customize->add_section( 'sf_impact_home_options', 
            array(
                'title' => __( 'General Options', 'sf-impact' ), 
                'priority' => 1, 
                'capability' => 'edit_theme_options',
                'description' => __('General Options for the Home Page', 'sf-impact'), //Descriptive tooltip
                'panel' => 'sf_impact_panel_home',
                ) 
            );
   
            //Setting to display sidebar on home page
            $wp_customize->add_setting( 'sf_impact_home_sidebar', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_home_sidebar'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
                   
            $wp_customize->add_control( 'sf_impact_home_sidebar', array(
                'settings' => 'sf_impact_home_sidebar',
                'label'    => __( 'Display sidebar on the homepage', 'sf-impact'),
                'section'  => 'sf_impact_home_options',
                            'priority' => 10,
                'type'     => 'checkbox',
            ) );
            //Setting for header content on home page
            $wp_customize->add_setting( 'sf_impact_home_header_type', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_home_header_type'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_select'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_home_header_type', 
                array(
                'label' => __( 'Home page Header', 'sf-impact' ), 
                'description' => __('What do you want to display as the header on your home page or front page?', 'sf-impact'),
                'section' => 'sf_impact_home_options', 
                'settings' => 'sf_impact_home_header_type', 
                'priority' => 10, 
                'type'     => 'radio',
		        'choices'  => array(
                    "2" => __('Display Nothing. My home page is beautiful without anything in the header.', 'sf-impact'),
                    "3" => __('Display the default WordPress header', 'sf-impact'),
			        "0"  => __('Display the Home Page Custom Header Image I select below', 'sf-impact'),
			        "1" => __('Display a Slideshow. I will pick which featured images will be displayed by selecting "include in slideshow" on the post.', 'sf-impact'),
                )
                ) 
            ) );

            //Setting for Image (if Header Image is selected above)
                $wp_customize->add_setting( 'sf_impact_header_image', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_header_image'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_image'
                ) 
            );      
            
     
            $wp_customize->add_control( new WP_Customize_Image_Control (
   
                $wp_customize, 
                'sf_impact_header_image', 
                array(
                'label' => __( 'Home page header image', 'sf-impact' ), 
                'section' => 'sf_impact_home_options', 
                'settings' => 'sf_impact_header_image', 
                'priority' => 10, 
           
                ) 
            ) );

  
            //Header height on home page
                $wp_customize->add_setting( 'sf_impact_header_height', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_header_height'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'esc_textarea'
                ) 
            );      
            $wp_customize->add_control( new WP_Customize_Control (
                $wp_customize, 
                'sf_impact_header_height', 
                array(
                'label' => __( 'Header image height' , 'sf-impact'),
                'description' => __('Height when custom home page header or slideshow is selected. If blank the default height will be used, use measurement (px, %, em)', 'sf-impact' ), 
                'section' => 'sf_impact_home_options', 
                'settings' => 'sf_impact_header_height', 
                'priority' => 10, 
                ) 
            ) );
            //Header width on home page 
           
            $wp_customize->add_setting( 'sf_impact_header_stretch', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_header_stretch'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
            
           $wp_customize->add_setting( "homelabel1", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "homelabel1",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' => __('Stretch the image when custom home page header or slideshow is selected.', 'sf-impact'), 'sf-impact', 'section' => 'sf_impact_home_posts',  'settings' => "homelabel1", 'priority' => 10, ) ) );    
            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_header_stretch', 
                array(
                'label' => __( 'Stretch the header image?', 'sf-impact' ), 
                 'section' => 'sf_impact_home_options', 
                'settings' => 'sf_impact_header_stretch', 
                'priority' => 10, 
                 'type' => 'checkbox',
                 
                 
                ) 
            ) );
           $wp_customize->add_setting( "homelabel2", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "homelabel2",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' => __('Check this option to display posts on the home page (this does not effect a static front page or blog page).', 'sf-impact'), 'sf-impact', 'section' => 'sf_impact_home_posts',  'settings' => "homelabel2", 'priority' => 10, ) ) );    
         //Setting to display posts on the home page    
            $wp_customize->add_setting( 'sf_impact_home_posts', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_home_posts'), 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
     
            $wp_customize->add_control( 'sf_impact_home_posts', array(
                'settings' => 'sf_impact_home_posts',
                'label'    => __( 'Display posts on the home page?', 'sf-impact' ), 
             
                'section'  => 'sf_impact_home_options',
                            'priority' => 10,
                'type'     => 'checkbox',
            ) );      
           $wp_customize->add_setting( "homelabel3", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "homelabel3",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' => __('You can display all posts or choose a single category in the dropdown box to display on the home page or alternately the blog page when a static front page is use.', 'sf-impact'),  'section' => 'sf_impact_home_posts',  'settings' => "homelabel3", 'priority' => 10, ) ) );     
            //Category for posts on the home page
            $wp_customize->add_setting( 'sf_impact_home_rp_categoryid', array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_home_rp_categoryid'), 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_category'

            ) );
            $wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 'sf_impact_home_rp_categoryid', array(
                'label' => __('Post listing category', 'sf-impact'),
                'description'   => __( 'You can display all posts or choose a single category in the dropdown box to display on the home page or alternately the blog page when a static front page is used ', 'sf-impact' ), 
                'section' => 'sf_impact_home_options',
                'settings'   => 'sf_impact_home_rp_categoryid',
                'priority' => 10
            ) ) );

    }

  
    function sf_impact_sliderOptions($wp_customize)
    {
        global $sf_impact_Theme_Mods;
            $wp_customize->add_section( 'sf_impact_slider_options', 
            array(
                'title' => __( 'Slide Show Options', 'sf-impact' ), 
                'priority' => 2, 
                'capability' => 'edit_theme_options',
                'description' => __('Slide show options', 'sf-impact'), //Descriptive tooltip
                'panel' => 'sf_impact_panel_home',
                ) 
            ); 
          $wp_customize->add_setting( "slidelabel1", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "slidelabel1",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' => __('Create navigation for paging control of each clide? Note: Leave true for manualControls usage', 'sf-impact'), 'section' => 'sf_impact_slider_options',  'settings' => "slidelabel1", 'priority' => 10, ) ) );         
        $wp_customize->add_setting('sf_impact_slider_navigation', 
            array (
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_navigation'), 
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'sf_impact_slider_navigation', array(
            'settings' => 'sf_impact_slider_navigation',
            'label'    => __( 'Show navigation buttons', 'sf-impact'),
     
            'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );
         $wp_customize->add_setting( "slidelabel2", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "slidelabel2",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' => __('navigation for previous/next navigation', 'sf-impact'),  'section' => 'sf_impact_slider_options',  'settings' => "slidelabel2", 'priority' => 10, ) ) );         
        $wp_customize->add_setting('sf_impact_slider_navdirection', 
            array (
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_navdirection'), 
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));

        $wp_customize->add_control( 'sf_impact_slider_navdirection', array(
            'settings' => 'sf_impact_slider_navdirection',
            'label'    => __( 'Show direction navigation', 'sf-impact'),
            'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );

         $wp_customize->add_setting( "slidelabel3", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "slidelabel3",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' => __('Allow slider navigating via keyboard left/right keys', 'sf-impact'),  'section' => 'sf_impact_slider_options',  'settings' => "slidelabel3", 'priority' => 10, ) ) );         
        $wp_customize->add_setting('sf_impact_slider_keyboard', 
            array (
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_keyboard'), 
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'sf_impact_slider_keyboard', array(
            'settings' => 'sf_impact_slider_keyboard',
            'label'    => __( 'Enable keyboard navigation', 'sf-impact'),
           'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );
           $wp_customize->add_setting( "slidelabel4", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "slidelabel4",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' =>  __(' Allow slider navigating via mousewheel', 'sf-impact'),   'section' => 'sf_impact_slider_options',  'settings' => "slidelabel4", 'priority' => 10, ) ) );         
        $wp_customize->add_setting('sf_impact_slider_mousewheel', 
            array (
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_mousewheel'),
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'sf_impact_slider_mousewheel', array(
            'settings' => 'sf_impact_slider_mousewheel',
            'label'    => __( 'Enable mousewheel navigation', 'sf-impact'),
     
            'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );
         $wp_customize->add_setting( "slidelabel5", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "slidelabel5",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' =>  __(' Pause the slideshow when hovering over slider, then resume when no longer hovering', 'sf-impact'),   'section' => 'sf_impact_slider_options',  'settings' => "slidelabel5", 'priority' => 10, ) ) );         
        $wp_customize->add_setting('sf_impact_slider_pauseonhover', 
            array (
            'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_pauseonhover'),
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'sf_impact_slider_pauseonhover', array(
            'settings' => 'sf_impact_slider_pauseonhover',
            'label'    => __( 'Pause on hover', 'sf-impact'),
            'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );
        $wp_customize->add_setting('sf_impact_slider_captions', 
            array (
             'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_captions'), 
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'sf_impact_slider_captions', array(
            'settings' => 'sf_impact_slider_captions',
            'label'    => __( 'Show captions', 'sf-impact'),
            'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );
  
                    //Setting for slideshow transition
            $wp_customize->add_setting( 'sf_impact_slider_transition', 
                array(
                 'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_transition'), 
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_select'
                ) 
            ); 

           $wp_customize->add_setting('sf_impact_slider_automate', 
                array (
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_automate'), 
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'transport' => 'refresh',
                'sanitize_callback' => 'sf_impact_sanitize_checkbox',
        ));
        $wp_customize->add_control( 'sf_impact_slider_automate', array(
            'settings' => 'sf_impact_slider_automate',
            'label'    => __( 'Animate slider automatically', 'sf-impact'),
            'section'  => 'sf_impact_slider_options',
            'priority' => 10,
            'type'     => 'checkbox',
        ) );
            $wp_customize->add_setting( 'sf_impact_slider_animspeed', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_animspeed'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_number_absint'
                ) 
            ); 
        $wp_customize->add_control (new Number_Custom_Control(
            $wp_customize, 'sf_impact_slider_animspeed',
                array(
                'label' => __( 'Slide Animation Speed', 'sf-impact' ), 
                'description' => __('Set the speed of animations, in milliseconds', 'sf-impact'),
                'section' => 'sf_impact_slider_options', 
             
                'priority' => 10, 
           
                ) 
            ));
        $wp_customize->add_setting( 'sf_impact_slider_speed', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_slider_speed'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_number_absint'
                ) 
            ); 
        $wp_customize->add_control( new Number_Custom_Control (
   
                $wp_customize, 
                'sf_impact_slider_speed', 
                array(
                'label' => __( 'Cycle Time', 'sf-impact' ), 
                    'description' => __('Set the speed of the slideshow cycling, in milliseconds', 'sf-impact' ), 
                'section' => 'sf_impact_slider_options', 
                'settings' => 'sf_impact_slider_speed', 
                'priority' => 10, 
           
                ) 
            ) );
           
    }
    function sf_impact_socialMediaOptions($wp_customize)
    {
        global $sf_impact_Theme_Mods;
        $wp_customize->add_section( 'sf_impact_social_media', array(
			    'title'          => __('Marketing Menu Bar', 'sf-impact'),
			    'priority'       => 4,
                'capability' => 'edit_theme_options',
                'description' => __('Social Media Icons', 'sf-impact'), //Descriptive tooltip
                //'panel' => 'sf_impact_panel',
	    ) );
            $wp_customize->add_setting( 'sf_impact_social_above_menu', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_social_above_menu'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_social_above_menu', 
                array(
                'label' => __( 'Display above menu', 'sf-impact' ), 
                'section' => 'sf_impact_social_media', 
                'settings' => 'sf_impact_social_above_menu', 
                'priority' => 10, 
                'type'     => 'checkbox',

                )
                 
            ) );  
 
 
            $wp_customize->add_setting( 'sf_impact_social_above_content', 
                array(
                 'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_social_above_content'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_social_above_content', 
                array(
                'label' => __( 'Display above content', 'sf-impact' ), 
                'section' => 'sf_impact_social_media', 
                'settings' => 'sf_impact_social_above_content', 
                'priority' => 10, 
                'type'     => 'checkbox',

                )
                  
            ) ); 
             $wp_customize->add_setting( 'sf_impact_social_above_footer', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_social_above_footer'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_social_above_footer', 
                array(
                'label' => __( 'Display above footer', 'sf-impact' ), 
                'section' => 'sf_impact_social_media', 
                'settings' => 'sf_impact_social_above_footer', 
                'priority' => 10, 
                'type'     => 'checkbox',

                )
                 
            ) );              
            $wp_customize->add_setting( 'sf_impact_icon_size', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_icon_size'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_select'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_icon_size', 
                array(
                'label' => __( 'Icon size', 'sf-impact' ), 
                'section' => 'sf_impact_social_media', 
                'settings' => 'sf_impact_icon_size', 
                'priority' => 10, 
                'type'     => 'radio',
		        'choices'  => array(
			        "1g"  => __('Default', 'sf-impact'),
			        "2x" => __('2x', 'sf-impact'),
                    "3x" => __('3x', 'sf-impact'),
                    "4x" => __('4x', 'sf-impact'),
                    "5x" => __('5x', 'sf-impact'),
                )
                ) 
            ) );  
	    $social_sites = sf_impact_social_media_array();
	    $priority = 5;
 
	    foreach($social_sites as $social_site) {
            $social_site_cap = ucfirst ( $social_site );
		    $wp_customize->add_setting( "$social_site", array(
				    'type'        => 'theme_mod',
				    'capability'       => 'edit_theme_options',
				    'sanitize_callback'       => 'esc_url_raw',
                    'transport' => 'refresh', 
		    ) );
            
		    $wp_customize->add_control( $social_site, array(
				    'label'   => sprintf("%s url",  $social_site_cap ),
				    'section' => 'sf_impact_social_media',
				    'type'    => 'text',
                    'label_attrs' => array(
                    'style' => 'text-transform:capitalize',
                    ),
 				    'priority'=> 10,
                
		    ) );
 
		
	    }
    }
    function sf_impact_customCSS($wp_customize)
    {
        global $sf_impact_Theme_Mods;
        $wp_customize->add_section( 'sf_impact_custom_css', array(
            'title' => __( ' Custom CSS Styles ', 'sf-impact' ), 
            'priority' => 8, 
            'capability' => 'edit_theme_options',
            'description' => __('Add custom CSS styles'), //Descriptive tooltip
            //'panel' => 'sf_impact_panel',
            ) 
        ); 
        $wp_customize->add_setting( 'sf_impact_custom_head_css', array(
	        'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_custom_head_css'),
	        'type' => 'theme_mod',
	        'capability' => 'edit_theme_options',
	        'transport' => 'postMessage',
			'sanitize_callback'    => 'sf_filter_css',
        ) );

        $wp_customize->add_control( 'sf_impact_custom_head_css', array(
         'settings' => 'sf_impact_custom_head_css',
            'type' => 'textarea',
            'description' => '',
            'priority' => 10,
            'section' => 'sf_impact_custom_css',
            'label' => __( 'Custom CSS for the header', 'textdomain' ),
            'description' => '',
        ) );
          $wp_customize->add_setting( 'sf_impact_custom_footer_css', array(
	        'default' =>  $sf_impact_Theme_Mods->getDefault('sf_impact_custom_footer_css'),
	        'type' => 'theme_mod',
	        'capability' => 'edit_theme_options',
	        'transport' => 'postMessage',
			'sanitize_callback'    => 'sf_filter_css',
        ) );

        $wp_customize->add_control( 'sf_impact_custom_footer_css', array(
            'settings' => 'sf_impact_custom_footer_css',
            'type' => 'textarea',
            'priority' => 10,
            'section' => 'sf_impact_custom_css',
            'label' => __( 'Custom CSS for the footer', 'textdomain' ),
            'description' => '',
        ) );
    }
      function sf_impact_editorDefaults($wp_customize)
    {
        global $sf_impact_Theme_Mods;
        
                $wp_customize->add_section( 'sf_impact_editor_defaults', 
            array(
                'title' => __( ' Editor Defaults ', 'sf-impact' ), 
                'priority' => 3, 
                'capability' => 'edit_theme_options',
                'description' => __('Save time when editing posts and pages by setting these default values', 'sf-impact'), //Descriptive tooltip
                'panel' => 'sf_impact_panel_post',
                ) 
            ); 
  
 
           $wp_customize->add_setting( "postlabel4", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

             $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "postlabel4",
                    array('type' => "text", 'style' => 'font-style:italic;',  'label' => __('The following settings are default settings for options that you choose while editing posts or pages. Changing these options will have no effect on appearance although they will effect posts or pages that  existed prior to installing this theme.  ', 'sf-impact'), 'section' => 'sf_impact_editor_defaults',  'settings' => "postlabel4", 'priority' => 10, ) ) );
           //Setting to display sidebar on posts
            $wp_customize->add_setting( 'sf_impact_post_sidebar', 
                array(
               'default' =>  $sf_impact_Theme_Mods->getDefault('sf_impact_post_sidebar'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
                   
            $wp_customize->add_control( 'sf_impact_post_sidebar', array(
                'settings' => 'sf_impact_post_sidebar',
                'label'    => __( 'Display the sidebar on post pages', 'sf-impact'), 
                'section'  => 'sf_impact_editor_defaults',
                'priority' => 10,
                'type'     => 'checkbox',
            ) );
            //Setting to featured image on posts
            $wp_customize->add_setting( 'sf_impact_post_featured', 
                array(
                'default' =>  $sf_impact_Theme_Mods->getDefault('sf_impact_post_featured'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
                   
            $wp_customize->add_control( 'sf_impact_post_featured', array(
                'settings' => 'sf_impact_post_featured',
                'label'    => __( 'Display the featured image on posts', 'sf-impact'), 
                'section'  => 'sf_impact_editor_defaults',
                'priority' => 10,
                'type'     => 'checkbox',
            ) );

                       //Setting to featured image on pages
            $wp_customize->add_setting( 'sf_impact_page_featured', 
                array(
                 'default' =>  $sf_impact_Theme_Mods->getDefault('sf_impact_page_featured'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
                   
            $wp_customize->add_control( 'sf_impact_page_featured', array(
                'settings' => 'sf_impact_page_featured',
                'label'    => __( 'Display the featured image on pages', 'sf-impact'), 
                'section'  => 'sf_impact_editor_defaults',
                'priority' => 10,
                'type'     => 'checkbox',
            ) );
    }
    function sf_impact_highlightSettings($wp_customize)
    {
            global $sf_impact_Theme_Mods;
            //********************************************************************************************************
            /*Featured Highlight Section*/
                $wp_customize->add_section( 'sf_impact_highlight_options', 
            array(
                'title' => __( ' Featured Highlights', 'sf-impact' ), 
                'priority' => 3, 
                'capability' => 'edit_theme_options',
                'description' => __('Customize the highlight section on the home page', 'sf-impact'), //Descriptive tooltip
                'panel' => 'sf_impact_panel_home',
                ) 
            ); 
        $wp_customize->add_setting( "hlabel6", array(   'transport' => 'refresh', 'sanitize_callback' => 'sanitize_text_field') );

            $wp_customize->add_control( new Arbitrary_Custom_Control($wp_customize,  "hlabel6",
                    array('type' => "text", 'style' => 'font-style:italic',   'label' =>  __('Turn on to display the featured highlight area.', 'sf-impact'),   'section' => 'sf_impact_highlight_options',  'settings' => "hlabel6", 'priority' => 10, ) ) );         
       //Setting to display featured highlights on the home page    
            $wp_customize->add_setting( 'sf_impact_home_featured_highlights', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_home_featured_highlights'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_checkbox'
                ) 
            );      
     
            $wp_customize->add_control( 'sf_impact_home_featured_highlights', array(
                'settings' => 'sf_impact_home_featured_highlights',
                'label'    => __( 'Display featured highlights on the home page?', 'sf-impact' ), 
                'section'  => 'sf_impact_highlight_options',
                            'priority' => 10,
                'type'     => 'checkbox',
            ) );       

           $wp_customize->add_setting( 
                    'linex', 
                    array(   'transport' => 'refresh', 
                    'sanitize_callback' => 'sanitize_text_field') );
            $wp_customize->add_control(
                new Arbitrary_Custom_Control(
                    $wp_customize,
                    'line1',
                    array(
                        'section' => 'sf_impact_highlight_options', 
                        'type' => 'line',
                        'settings' => 'line1', 
                        'priority' => 10, 
                    )
                )
            );
            
            $wp_customize->add_setting( 'sf_impact_highlight_boxes', 
                array(
                'default' => $sf_impact_Theme_Mods->getDefault('sf_impact_highlight_boxes'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_number_absint'
                ) 
            );      
            $wp_customize->add_control( new Number_Custom_Control (
   
                $wp_customize, 
                'sf_impact_highlight_boxes', 
                array(
                'label' => __( 'Number of highlight boxes to display', 'sf-impact' ), 
                'section' => 'sf_impact_highlight_options', 
                'settings' => 'sf_impact_highlight_boxes', 
                'min' => '0',
                'max' => '3',
                'priority' => 10, 
           
                ) 
            ) );

            $wp_customize->add_setting( 'sf_impact_highlight_style', 
                array(
                'default' =>$sf_impact_Theme_Mods->getDefault('sf_impact_highlight_style'),
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sf_impact_sanitize_select'
                ) 
            );      

            $wp_customize->add_control( new WP_Customize_Control (
   
                $wp_customize, 
                'sf_impact_highlight_style', 
                array(
                'label' => __( 'Highlight Image Position', 'sf-impact' ), 
                'section' => 'sf_impact_highlight_options', 
                'settings' => 'sf_impact_highlight_style', 
                'priority' => 10, 
                'type'     => 'radio',
		        'choices'  => array(
			        "L"  => __('Left', 'sf-impact'),
			        "R" => __('Right', 'sf-impact'),
                    "T" => __('Top', 'sf-impact'),
                
                )
                ) 
            ) );  
            $wp_customize->add_setting( 
            'line1', array(   'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_text_field') );
    
        for ($x = 1; $x <= 3; ++$x) 
            :
            $label = 'label' . $x;
            $line = 'line' .$x;
              
                $wp_customize->add_setting("$line", array(   'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_text_field'));
                $wp_customize->add_setting( "$label", array(   'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_text_field') );
  
                $name = "sf_impact_highlight_header$x";
    
                $wp_customize->add_setting( "$name", 
                    array(
                     'default' => $sf_impact_Theme_Mods->getDefault( $name ),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sanitize_text_field'
                    ) 
                );      
                    $name = "sf_impact_highlight_image$x";
                $wp_customize->add_setting( "$name", 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault( $name ),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'esc_url_raw'
                    ) 
                );      
                $name = "sf_impact_highlight_text$x";
                $wp_customize->add_setting( "$name", 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault( $name ),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'sanitize_text_field'
                    ) 
                );        
                
            $wp_customize->add_control(
            new Arbitrary_Custom_Control(
                    $wp_customize,
                    "$line",
                    array(
                        'type' => 'line',
                        'section' => 'sf_impact_highlight_options', 
                        'settings' => "$line", 
                        'priority' => 10, 
                    )
                )
            );
            $tx = __("Featured Highlight", 'sf-impact');
            $title = sprintf("%s %s", $tx, $x);
            $wp_customize->add_control(
                new Arbitrary_Custom_Control(
                    $wp_customize,
                    "$label",
                    array(
                        'type' => "h3",
                        'label' => $title, 
                        'section' => 'sf_impact_highlight_options', 
                        'settings' => "$label", 
                        'priority' => 10, 
                    )
                )
            );
            $name = "sf_impact_highlight_header$x";
            $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    "$name",
                    array(
                    'label' => __( "Header" , 'sf-impact' ), 
                    'section' => 'sf_impact_highlight_options', 
                    'settings' => $name, 
                    'priority' => 10, 
               
           
                    ) 
                ) );
  
            $name = "sf_impact_highlight_text$x";
                $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    "$name", 
                    array(
                    'label' => __( "Text", 'sf-impact' ), 
                    'section' => 'sf_impact_highlight_options', 
                    'settings' => $name, 
                    'priority' => 10, 
           
                    ) 
                ) );

                $name = "sf_impact_highlight_link$x";
                $wp_customize->add_setting( "$name", 
                    array(
                    'default' => $sf_impact_Theme_Mods->getDefault($name),
                    'type' => 'theme_mod', 
                    'capability' => 'edit_theme_options', 
                    'transport' => 'refresh', 
                    'sanitize_callback' => 'esc_url_raw'
                    ) 
                );   
                $wp_customize->add_control( new WP_Customize_Control (
   
                    $wp_customize, 
                    "$name", 
                    array(
                    'label' => __( "Link", 'sf-impact' ), 
                    'description' => __('Enter the link for the highlight.You can leave this blank if you do not want the highlight to link to another page', 'sf-impact'),
                    'section' => 'sf_impact_highlight_options', 
                    'settings' => $name, 
                    'priority' => 10, 
           
                    ) 
                ) );   
                $name = 'sf_impact_highlight_image' . $x;
                $wp_customize->add_control( new WP_Customize_Image_Control (
   
                    $wp_customize, 
                    "$name", 
                    array(
                    'label' => __( "Image Url", 'sf-impact' ), 
                    'section' => 'sf_impact_highlight_options', 
                    'settings' => $name, 
                    'priority' => 10, 
                
           
                    ) 
                ) );
        endfor;       
    }
    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    public function sf_impact_customize_preview_js() {
	    wp_enqueue_script( 'sf_impact_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), '20130508', true );
    }
    
    public function sf_impact_footer_output()
    {
       global $sf_impact_Theme_Mods;

          $sf_impact_custom_footer_css = $sf_impact_Theme_Mods->getMod( 'sf_impact_custom_footer_css' );

         if ($sf_impact_custom_footer_css != "" ): ?>
        <style type="text/css">
            <?php echo $sf_impact_custom_footer_css; ?>
        </style>
        <?php endif;

   

    }

    public function sf_impact_header_output() 
    {
        global $sf_impact_Theme_Mods;
            ?>
            <!--Customizer CSS--> 
            <style type="text/css">
                <?php 
                $sf_impact_custom_head_css      = $sf_impact_Theme_Mods->getMod( 'sf_impact_custom_head_css' );
              
                $sf_impact_header_background    = $sf_impact_Theme_Mods->getMod( 'sf_impact_header_background' );
                $sf_impact_content_background   = $sf_impact_Theme_Mods->getMod( 'sf_impact_content_background' );
                $sf_impact_header_opacity       = $sf_impact_Theme_Mods->getMod( 'sf_impact_header_opacity' );
                $outu = "";
                if ($sf_impact_header_opacity < 100) {
                    $hstyle = sf_impact_rbgastyle($sf_impact_header_background, $sf_impact_header_opacity);
                    echo "#topmasthead {" . $hstyle . "}";
                } else {
                    $outu .= sprintf("%s {%s:%s;}", "#topmasthead", "background-color", $sf_impact_header_background); 
                }   
                $site = "#" . get_header_textcolor();
                
                $customStyles = $this->customStylesObj->getThemeSettings();
                $stylesheet = $this->customStylesObj->getStylesheet(); 
                $outu .= $stylesheet['css']; 
                $outu .= sprintf( "%s {%s:%s;} %s {%s:%s;}", ".site-title", "color", $site, ".site-description", "color", $site ); 
               
                $outu .= sprintf( "%s {%s:%s;}", "body", "background-color", get_background_color() );  
                $outu .= sprintf( "%s {%s:%s;}", ".flexslider", "min-height", $sf_impact_Theme_Mods->getMod('sf_impact_header_height') );
                $menuhex = $sf_impact_Theme_Mods->getMod('sf_impact_content_background');
                
                $sf_impact_content_opacity = $sf_impact_Theme_Mods->getMod( 'sf_impact_content_opacity' );
                if ($sf_impact_content_opacity < 100) {
                    $hstyle = sf_impact_rbgastyle($sf_impact_content_background,  $sf_impact_content_opacity);
                    $outu.= "#masthead, #content {" . $hstyle . "}";
                } else {
                    $outu .= sprintf("%s {%s:%s;}", "#masthead, #content", "background-color", $sf_impact_content_background);                      echo $outu;
                }           
                if ($sf_impact_custom_head_css != '') 
                    $outu .= $sf_impact_custom_head_css;
                    
                echo $outu;
                ?>
            </style>
            
            <!--/Customizer CSS-->
            <?php
    }
   


}
endif;
$cust = new sf_impact_Customize();
function sf_impact_sanitize_checkbox( $checked ) {
// Boolean check.
return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
function sf_impact_sanitize_dropdown_pages( $page_id, $setting ) {
// Ensure $input is an absolute integer.
if (intval($page_id) == 0) return $page_id;
$page_id = absint( $page_id );
	
// If $page_id is an ID of a published page, return it; otherwise, return the default.
return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function sf_impact_sanitize_category( $category_id, $setting ) {
// Ensure $input is an absolute integer.
if (intval($category_id) == 0) return $category_id;
$category_id = absint( $category_id );
	
// If $page_id is an ID of a published page, return it; otherwise, return the default.
return ( get_the_category_by_ID( $category_id ) ? $category_id : $setting->default );
}

function sf_impact_sanitize_image( $image, $setting ) {
/*
	* Array of valid image file types.
	*
	* The array includes image mime types that are included in wp_get_mime_types()
	*/
$image = esc_url_raw($image);
if ($image == "") return $image;
$mimes = array(
    'jpg|jpeg|jpe' => 'image/jpeg',
    'gif'          => 'image/gif',
    'png'          => 'image/png',
    'bmp'          => 'image/bmp',
    'tif|tiff'     => 'image/tiff',
    'ico'          => 'image/x-icon'
);
// Return an array with file extension and mime_type.
$file = wp_check_filetype( $image, $mimes );
// If $image has a valid mime_type, return it; otherwise, return the default.
return ( $file['ext'] ? $image : $setting->default );
}
function sf_impact_sanitize_number_absint( $number, $setting ) {
// Ensure $number is an absolute integer (whole number, zero or greater).
if (intval($number) == 0)
    return 0;
$number = absint( $number );
	
// If the input is an absolute integer, return it; otherwise, return the default
return ( $number ? $number : $setting->default );
}
function sf_impact_sanitize_number_range( $number, $setting ) {
if (intval($number) != 0)
// Ensure input is an absolute integer.
	$number = absint( $number );
else
    $number = intval($number);
// Get the input attributes associated with the setting.
$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
// Get minimum number in the range.
$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
// Get maximum number in the range.
$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
// Get step.
$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
// If the number is within the valid range, return it; otherwise, return the default
return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
function sf_impact_sanitize_select( $input, $setting ) {
//case insensitive. (Serious pain in the ass)

$input = sanitize_key( $input );
	
// Get list of choices from the control associated with the setting.
$choices = $setting->manager->get_control( $setting->id )->choices;
  
$found = FALSE;
foreach (array_keys($choices) as $key => $value)
{
      
    if (strtolower($value) == strtolower($input)) {
        $fvalue = $value;
        $found = TRUE;
        break;
    }
}
   
if  ($found) return $fvalue; else return $setting->default;
// If the input is a valid key, return it; otherwise, return the default.*/
//return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


//Function credit @mpatek http://stackoverflow.com/a/25167679
function sf_filter_css($text) {
    return implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $text ) ) );
}
?>