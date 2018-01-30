<?php
//=========================================================Functions
/*
* Generate Style for the home page header 
*/
//Functions
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if (!function_exists('sf_impact_get_home_header_class')):
    function sf_impact_get_home_header_class()
    {
        global $sf_impact_Theme_Mods;
            //Get the header style
            $sf_impact_header_style = $sf_impact_Theme_Mods->getMod('sf_impact_header_style');
            //Get the header height
           $sf_impact_header_height = (stristr($sf_impact_header_style, "fix") === FALSE) ? "" :$sf_impact_Theme_Mods->getMod( 'sf_impact_header_height' );
            //Make sure that the height is set for fixed height options
            if (!$sf_impact_header_height && (stristr($sf_impact_header_style, "fix") >= 0))
            {   //If not, default to the default value
                $sf_impact_header_style = $sf_impact_Theme_Mods->getDefault('sf_impact_header_style'); 
            }

            $class = stristr($sf_impact_header_style, 'stretch') === FALSE  ? "sfly-img-fit " : "sfly-img-stretch ";
            $class .= stristr($sf_impact_header_style, 'fixed') === FALSE ? "sfly-img-auto " : "sfly-img-fixed ";

   
        return $class;
    }
endif;
if (!function_exists('sf_impact_get_home_header_height')):
    function sf_impact_get_home_header_height($max=false)
    {
     
       global $sf_impact_Theme_Mods;
            //Get the header style
            $sf_impact_header_style = $sf_impact_Theme_Mods->getMod('sf_impact_header_style');
            //Get the header height
           $sf_impact_header_height = (stristr($sf_impact_header_style, "fix") === FALSE) ? "" :$sf_impact_Theme_Mods->getMod( 'sf_impact_header_height' );
  
            $style = "";
            
            if ($sf_impact_header_height)
            {
                if ($max) $h = "max-height"; else $h = "height";
                $style .="$h:$sf_impact_header_height;";
            }
                    
            return $style;
    }
endif;

/*
* Scripts if the header is a slideshow
*/

if (!function_exists('sf_impact_slideshow_scripts')):
    //wp_footer filter
    function sf_impact_slideshow_scripts()
    {

        global $sf_impact_Theme_Mods;     
        $sf_impact_slider_transition = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_transition' );
        $sf_impact_slider_animspeed = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_animspeed' );
        $sf_impact_slider_speed = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_speed' );
        $sf_impact_slider_automate = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_automate')  == TRUE ? 'true' : 'false';
        $sf_impact_slider_direction = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_direction' );
        $sf_impact_slider_navigation = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_navigation') == TRUE ? "true" : "false";
        $sf_impact_slider_navdirection = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_navdirection') == TRUE ? "true" : "false";
        $sf_impact_slider_keyboard = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_keyboard') == TRUE ? "true" : "false";
        $sf_impact_slider_mousewheel = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_mousewheel') == TRUE ? "true" : "false";
        $sf_impact_slider_pauseonhover = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_pauseonhover') == TRUE ? "true" : "false";

         ?>
       	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('.flexslider').flexslider(
            {
                animation: "<?php echo esc_attr($sf_impact_slider_transition);?>",              //String: Select your animation type, "fade" or "slide"
                slideDirection: "<?php echo esc_attr($sf_impact_slider_direction); ?>",   //String: Select the sliding direction, "horizontal" or "vertical"
                slideshow: "<?php echo  ($sf_impact_slider_automate); ?>",                //Boolean: Animate slider automatically
               useCSS: false,
                slideshowSpeed: <?php echo intval($sf_impact_slider_speed) ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
                animationDuration: <?php echo intval($sf_impact_slider_animspeed) ?>,         //Integer: Set the speed of animations, in milliseconds
                directionNav: <?php echo esc_attr($sf_impact_slider_navdirection) ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
                controlNav: <?php echo esc_attr($sf_impact_slider_navigation) ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                keyboardNav: <?php echo esc_attr($sf_impact_slider_keyboard)?>,              //Boolean: Allow slider navigating via keyboard left/right keys
                mousewheel: <?php echo esc_attr($sf_impact_slider_mousewheel) ?>,               //Boolean: Allow slider navigating via mousewheel
                prevText: "<?php echo __("Previous", 'sf-impact')?>",           //String: Set the text for the "previous" directionNav item
                nextText: "<?php echo __("Next", 'sf-impact')?>",               //String: Set the text for the "next" directionNav item
                pausePlay: false,               //Boolean: Create pause/play dynamic element
                pauseText: "<?php echo __('Pause', 'sf-impact') ?>",             //String: Set the text for the "pause" pausePlay item
                playText: "<?php echo __('Play', 'sf-impact')?>",               //String: Set the text for the "play" pausePlay item
                randomize: false,               //Boolean: Randomize slide order
                slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
                animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
                pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
                pauseOnHover: <?php echo esc_attr($sf_impact_slider_pauseonhover)?>,            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
                controlsContainer: "flexslider",          //Selector: Declare which container the navigation elements should be appended too. Default container is the flexSlider element. Example use would be ".flexslider-container", "#container", etc. If the given element is not found, the default action will be taken.
                manualControls: "",             //Selector: Declare custom control navigation. Example would be ".flex-control-nav li" or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
 
            });
            
		});
        </script>
        <?php        
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
 
    
 
    function sf_impact_get_thumbnailarray()
    {
        
        
        global $sf_impact_Theme_Mods;      
        $type = $sf_impact_Theme_Mods->getMod('sf_impact_grid_type');
        $gridwidth = "99%";
        $posts = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_posts');
        $height = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_image_height' );
        $width= $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_image_width');
        $cellwidth = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_cell_width' );
        $cellheight = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_cell_height');
        $category = $sf_impact_Theme_Mods->getMod( 'sf_impact_post_category');
        $imagesize = $sf_impact_Theme_Mods->getMod( 'sf_impact_image_size_name');
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
         
         $arra = apply_filters('sf_impact_get_thumbnail_args', $arra);
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
        $type = $sf_impact_Theme_Mods->getMod('sf_impact_grid_type');
      
        $tax = get_object_taxonomies( $type, 'taxonomy' );
       
        if (array_key_exists ('category' , $tax ))
        {
            $category = $sf_impact_Theme_Mods->getMod( 'sf_impact_post_category');
            $page = $sf_impact_Theme_Mods->getMod('sf_impact_thumbnail_more_page');
       

            if ($category)
                $url = get_category_link($category);
            else
                $url = get_permalink( $page );
        }
        else
            $url = get_post_type_archive_link( $type );
 
        $url =  apply_filters('sf_impact_get_thumbnail_url', $url);
        return $url;
    }
endif;
/*
* Display Featured Highlight Boxes
*/
if (!function_exists('sf_impact_get_highlightboxes')):
    function sf_impact_get_highlightboxes()
    {
        do_action('sf_impact_highlights');
  
    }
endif;
if (!function_exists('sf_impact_highlightboxes_default')):
    function sf_impact_highlightboxes_default()
    {
            global $sf_impact_Theme_Mods;  
            $sf_impact_highlight_boxes = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_boxes');
            $sf_impact_home_featured_more = $sf_impact_Theme_Mods->getMod('sf_impact_home_featured_more');
            $boxcount = intval( $sf_impact_highlight_boxes );
            if ($boxcount > 0) 
            { 
                $sf_impact_highlight_style = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_style' );
         
                for ($x = 0; $x <= 3; ++$x) 
                {
                    ${'sf_impact_highlight_image' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_image' . $x);
                    ${'sf_impact_highlight_header' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_header' . $x);
                    ${'sf_impact_highlight_text' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_text' . $x );
                    ${'sf_impact_highlight_link' . $x} = $sf_impact_Theme_Mods->getMod( 'sf_impact_highlight_link' . $x );
                }
             ?>
                <div class="home-highlight-boxes fixed sfcenter">
                    <?php
             
                    $grid = 12/$boxcount;
                    for ($x = 1; $x <= $boxcount; $x++)  :?>

                        <div class="highlight-<?php echo intval($boxcount) ?>-col highlight-box highlight-box-<?php echo intval($boxcount)?> grid_<?php echo intval($grid);?> sfchild">
                           <div class="highlight-box-container fixed highlight-box-<?php echo intval($x)?>" >
                            <?php 
                            switch ($sf_impact_highlight_style)
                            {
                            default:
                            case ('L'):
                            {
                               if (${'sf_impact_highlight_image' . $x} != "")
                               {    sf_impact_genHighlightImg(${'sf_impact_highlight_image' . $x}, ${'sf_impact_highlight_link' . $x}, "highlight-left-img highlight-img-$x", ${"sf_impact_highlight_text$x"});     
                                    $class="highlight-right-text highlight-text-$x";
                                }
                                else
                                {
                                        $class="highlight-full highlight-text-$x";
                                }
                                sf_impact_genHighlightText  (${"sf_impact_highlight_header$x"}, ${'sf_impact_highlight_link' . $x},  ${"sf_impact_highlight_text$x"}, $class); 
                            break;
                            }
                            case ("T"):
                            {
                                if (${'sf_impact_highlight_image' . $x} != "")
                                {
                                     sf_impact_genHighlightImg(${'sf_impact_highlight_image' . $x}, ${'sf_impact_highlight_link' . $x},  "highlight-top-img highlight-img-$x", ${"sf_impact_highlight_text$x"});
                                }
                                 sf_impact_genHighlightText  (${"sf_impact_highlight_header$x"}, ${'sf_impact_highlight_link' . $x},  ${"sf_impact_highlight_text$x"}); 
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
                                 sf_impact_genHighlightText  (${"sf_impact_highlight_header$x"}, ${'sf_impact_highlight_link' . $x},  ${"sf_impact_highlight_text$x"}, $class); 
                                if (${'sf_impact_highlight_image' . $x} != "")
                                {        
                                     sf_impact_genHighlightImg(${'sf_impact_highlight_image' . $x}, ${'sf_impact_highlight_link' . $x},  "highlight-right-img highlight-img-$x", ${"sf_impact_highlight_text$x"});    
                                }
                               break;
                    
                            }
                            }
                            if (${'sf_impact_highlight_link' . $x} != "" && $sf_impact_home_featured_more)
                                {?>
                                  <div class="highlight-link"><a class="read-more btn" href="<?php echo esc_url(${'sf_impact_highlight_link' . $x});?>"><?php echo __('more', 'sf-impact');?></a></div>   
 
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
            } //Boxcount
        }
        
endif;
/*
* Get the html for the image for the featured highlight
* $imagename - path to the image
* $class - class for the img div (Image can be on top, left or right of box)
*/
if (!function_exists('sf_impact_genHighlightImg')):
    function sf_impact_genHighlightImg($imagename, $link, $class, $alt)
    {
        
        $img = sprintf('<img class="highlight-img" alt="%s" src="%s" />', esc_html($alt), esc_url($imagename) );
        if ($link != "") { $img = sprintf( '<a href="%s">%s</a>', $link, $img ); } 

        ?>
            <div class="<?php echo $class?>">
                <?php echo $img; ?>
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
if (!function_exists('sf_impact_genHighlightText')):
    function sf_impact_genHighlightText($header, $link, $text, $class="highlight-full")
    {        
    ?>
        <div class="<?php echo $class?>"> 
            <div class="highlight-span">
                <h2>
                    <?php if ( $link != ''): ?><a href="<?php echo esc_url($link); ?>"><?php endif; ?>
                        <?php echo esc_attr($header);?>
                    <?php if ( $link != ''): ?></a><?php endif; ?>
                </h2>
                <p><?php echo esc_attr($text);?></p>
            </div>
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
        $sf_impact_grid_display = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_display');
        $sf_impact_grid_display_all = $sf_impact_Theme_Mods->getMod( 'sf_impact_grid_display_all');
      
           //Load script for thumbnail grid
         if (class_exists('thumbnailgrid'))
        {
            if ( is_front_page())
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
* Generate Query for the Slideshow
*/
if (!function_exists('sf_impact_slideshow_query')):
    function sf_impact_slideshow_query()
    {
        
        global $sf_impact_Theme_Mods;
        wp_reset_query();
        $args = array(
            'ignore_sticky_posts' => TRUE,
            'post_type' => 'post',
            'posts_per_page' => $sf_impact_Theme_Mods->getMod('sf_impact_slider_count', 5),
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
        $args = apply_filters("sfimpact_slideshow_query", $args);
        $the_query =   new WP_Query($args);
        
        return $the_query;        
    }
endif;
/*
* HTML for the Home Page Slide Show
* $the_query - the query result 
* $wclass - class fit or stretch
* $hstyle - style for the slide show, height 
*/
if (!function_exists('sf_impact_get_slideshow')):
    function sf_impact_get_slideshow($the_query, $wclass, $height)
    {
          global $sf_impact_Theme_Mods;
       
          $format =  $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_style' ); //format, height & width settings
   
          $sf_impact_slider_captions = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_captions') ;
          $istyle = "";
          if ($sf_impact_slider_captions) 
                $wclass .= " has-captions";
          $sf_impact_slider_navigation = $sf_impact_Theme_Mods->getMod('sf_impact_slider_navigation');
          if ($sf_impact_slider_navigation)
           $wclass .= " has-navigation";
           $hstyle = ($height != "") ?  "height:auto;max-height:$height;" : "";

       
            ?>

         
    		<div class="flexslider"> 
		    <ul class="slides fixed <?php echo $wclass?>" data-sfheight="<?php echo $height?>">
                    <?php 
                     $sf_impact_slider_thumbnails = $sf_impact_Theme_Mods->getMod( 'sf_impact_slider_thumbnails') == TRUE ? "true" : "false";
                     while ( $the_query->have_posts() )  :$the_query->the_post();
                            $permalink = get_permalink();
                            $title = get_the_title();
                            $id = get_the_ID();
                            $image_id = get_post_thumbnail_id();
                            $image_atts = wp_get_attachment_image_src($image_id, "full", true);
                            $image_url = $image_atts[0] ;
                            $tnimage_atts = wp_get_attachment_image_src($image_id, "thumbnail", true);
                            $tnimage_url = esc_url($tnimage_atts[0]);
                            if ($sf_impact_slider_thumbnails)
                                $datathumb = "data-thumb='$tnimage_url'";
                            else
                                $datathumb = "";
                            if ($image_url && strpos($image_url, 'default.png') == FALSE)
                            {
                              
                                $hid = "title" . $id;
                                ?>
                 	            <li <?php echo $datathumb?> >
		    		            <a href="<?php echo esc_url($permalink) ?>"><img src="<?php echo esc_url($image_url)?>" alt="<?php echo esc_attr($title)?>" style="<?php echo $hstyle; ?>"/>
                                <?php if ($sf_impact_slider_captions==true) { ?>
		    		                <p class="flex-caption"><?php echo esc_attr($title);?></p>
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
 /*
 * Query & display post list for the home page or the blog page
 */
 if (!function_exists('sf_impact_home_query')):
     function sf_impact_home_query()
     {
         do_action('sf_impact_home_query');
     }
 endif;

 if (!function_exists('sf_impact_default_home_query')):
    function sf_impact_default_home_query()
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
    
        sf_impact_posts($the_query, sf_impact_count_sticky());

        wp_reset_postdata();
        
 }
 endif;
 /*
 * Display the post list on the home page or the blog page 
 */
if (!function_exists('sf_impact_posts')):
    function sf_impact_posts($the_query, $stickycount = 0)
    {
        do_action('sf_impact_posts', $the_query, $stickycount);
 
    }
endif;
/*
* Default Post Loop
*/
if (!function_exists('sf_impact_default_posts')):
    function sf_impact_default_posts($the_query, $stickycount=0)
    {
        global $sf_impact_Theme_Mods;
   
       
        if ( $the_query->have_posts() ) :  ?>
        <div>
  		<?php /* Start the Loop */ ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
               
                $current_post_index = $the_query->current_post ;   //Get the current index
                $displayfullpost  = sf_impact_postContentFullPage();  //Check to see if the option to display excerpts is on or off
                $sf_impact_show_full_sticky_post = FALSE;  //Check to see if the sticky as full post option is on 
                if (is_sticky() && !$displayfullpost )  //The sticky as full post is only valid when excerpts are enabled.
                   $sf_impact_show_full_sticky_post = ($sf_impact_Theme_Mods->getMod( 'sf_impact_show_full_sticky_post') && $current_post_index  < $stickycount);      //Make sure that all sticky posts at the top display as full if this is set
                ?>      
			<?php
    
                if ($displayfullpost)
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

/*
* Check to see if the full post should be displayed or the excerpt

*/
if ( ! function_exists( 'sf_impact_postContentFullPage' ) ) :
    function sf_impact_postContentFullPage()
    {
        global $sf_impact_Theme_Mods;
        $displayfullpost = TRUE;  //Default to display full post
     
        if (!is_search()) {
            if (is_archive()) {
        
                $displayfullpost = ! $sf_impact_Theme_Mods->getMod( 'sf_impact_show_excerpt_archive_post');
        
            } else {
                if ((!is_single()  && !is_page()) ) {
                    $displayfullpost = !$sf_impact_Theme_Mods->getMod( 'sf_impact_show_excerpt_blog_post');    
                }
          
            }
        } else { 
            $displayfullpost = FALSE; // Not an option for search
        }
        
        
        return $displayfullpost;
    }
endif;
 /*
* Main code for the header image
*/
if (!function_exists('sf_impact_header')):
    function sf_impact_header($sf_impact_home_header_type, $sf_impact_header_image, $sf_impact_logo_location, $the_slide_query = NULL, $logo="top")
    {
        do_action('sf_impact_header', $sf_impact_home_header_type, $sf_impact_header_image, $sf_impact_logo_location, $the_slide_query, $logo);
    }
endif;

if (!function_exists('sf_impact_default_header')):
    function sf_impact_default_header($sf_impact_home_header_type, $sf_impact_header_image, $sf_impact_logo_location, $the_slide_query = NULL, $logo="top")
    {
        $wclass = sf_impact_get_home_header_class();
        if ($sf_impact_home_header_type == "1" && isset($the_slide_query)) {    
           
            global $sf_impact_Theme_Mods;
            
       global $sf_impact_Theme_Mods;
            //Get the header style
            $sf_impact_header_style = $sf_impact_Theme_Mods->getMod('sf_impact_header_style');
            //Get the header height
           $height = (stristr($sf_impact_header_style, "fix") === FALSE) ? "": $sf_impact_Theme_Mods->getMod( 'sf_impact_header_height' );
        
            do_action('sf_impact_slideshow', $the_slide_query, $wclass, $height) ;
        } else {
            if ($sf_impact_header_image && $sf_impact_home_header_type == "0") {
                  $hstyle = sf_impact_get_home_header_height(true);
                  if ($hstyle) $hstyle = "style='$hstyle'";
                ?>
                <div class="header-container-home <?php echo $wclass?> ">

                    <?php if ($logo=="image"){ ?>
                       
                            <div class="site-branding fixed shoofly-branding-image" >
                                <?php do_action('sf_impact_before_branding');?>
                                

                                <?php get_template_part('template-parts/branding');?>
                                <?php do_action('sf_impact_after_branding');?>
            		        </div>
                       
                    <?php }?>
                    <img class="headerimg" alt="header" <?php echo  $hstyle?> src="<?php echo esc_url($sf_impact_header_image); ?>"/>
                </div><?php
                $output = "";
                $output = apply_filters('sf_impact_home_post_bar', $output);
                if ( $output != '' )
                {
                    ?><div id="homepostbar">
                    <?php
                            echo esc_attr($output);?>
                    </div>
                    <?php
                }
             }
         }
    
    }
endif;

