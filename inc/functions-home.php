<?php

 //=========================================================Functions
/*
* Generate Style for the home page header 
*/
if (!function_exists('sf_impact_get_home_header_style')):
    function sf_impact_get_home_header_style()
    {
            $sf_impact_header_height = get_theme_mod('sf_impact_header_height', "");
            $sf_impact_header_width = get_theme_mod( 'sf_impact_header_width', "100%");
            $style = sf_impact_get_home_header_width() . sf_impact_get_home_header_height();
            return $style;
    }
endif;
if (!function_exists('sf_impact_get_home_header_width')):
    function sf_impact_get_home_header_width()
    {
           
            $sf_impact_header_width = get_theme_mod( 'sf_impact_header_width', "100%");
            $style = "";
            if ($sf_impact_header_width != '')
                        $style .= "width:" . $sf_impact_header_width . "!important;";
        
  
            return $style;
    }
endif;
if (!function_exists('sf_impact_get_home_header_height')):
    function sf_impact_get_home_header_height()
    {
            $sf_impact_header_height = get_theme_mod('sf_impact_header_height', "");
            $style = "";
        
            if ($sf_impact_header_height)
                    $style .= "height:" . $sf_impact_header_height . "!important;";
            return $style;
    }
endif;
/*
* Footer script for slideshow
*/

if (!function_exists('sf_impact_slideshow_scripts')):

    function sf_impact_slideshow_scripts()
    {
       
        $sf_impact_slider_transition = get_theme_mod('sf_impact_slider_transition', 'fade');
        $sf_impact_slider_animspeed = get_theme_mod('sf_impact_slider_animspeed', '500');
        $sf_impact_slider_speed = get_theme_mod('sf_impact_slider_speed', '7000');
        $sf_impact_slider_automate = get_theme_mod('sf_impact_slider_automate', true)  == TRUE ? 'true' : 'false';
        $sf_impact_slider_direction = get_theme_mod('sf_impact_slider_direction', 'horizontal');
        $sf_impact_slider_navigation = get_theme_mod('sf_impact_slider_navigation', FALSE) == TRUE ? "true" : "false";
        $sf_impact_slider_navdirection = get_theme_mod('sf_impact_slider_navdirection', FALSE) == TRUE ? "true" : "false";
        $sf_impact_slider_keyboard = get_theme_mod('sf_impact_slider_keyboard', true) == TRUE ? "true" : "false";
        $sf_impact_slider_mousewheel = get_theme_mod('sf_impact_slider_mousewheel', true) == TRUE ? "true" : "false";
        $sf_impact_slider_pauseonhover = get_theme_mod('sf_impact_slider_pauseonhover', false) == TRUE ? "true" : "false";

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
* Display Featured Highlight Boxes
*/
if (!function_exists('sf_impact_get_highlightboxes')):
    function sf_impact_get_highlightboxes()
    {
      
        $sf_impact_highlight_boxes = get_theme_mod('sf_impact_highlight_boxes', 0);
        $boxcount = intval( $sf_impact_highlight_boxes );
        if ($boxcount > 0) 
        { 
            $sf_impact_highlight_style = get_theme_mod('sf_impact_highlight_style', "L");
         
            for ($x = 0; $x <= 3; ++$x) 
            {
                ${'sf_impact_highlight_image' . $x} = get_theme_mod('sf_impact_highlight_image' . $x, '');
                ${'sf_impact_highlight_header' . $x} = get_theme_mod('sf_impact_highlight_header' . $x, '');
                ${'sf_impact_highlight_text' . $x} = get_theme_mod('sf_impact_highlight_text' . $x, '');
                ${'sf_impact_highlight_link' . $x} = get_theme_mod('sf_impact_highlight_link' . $x, '#');
            }

 
    
    
         ?>
    
            <div class="home-highlight-boxes fixed sfcenter">
                <?php
 
                $grid = 12/$boxcount;
                for ($x = 1; $x <= $boxcount; $x++)  :?>

                    <div class="highlight-<?php echo $boxcount ?>-col highlight-box highlight-box-<?php echo $boxcount?> grid_<?php echo $grid;?> sfchild">
                       <div class="highlight-box-container fixed " >
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
 if (!function_exists('sf_impact_is_grid')):
    function sf_impact_is_grid()
    {
        $grid = FALSE;
        $sf_impact_grid_display = get_theme_mod('sf_impact_grid_display', FALSE);
        $sf_impact_grid_display_all = get_theme_mod('sf_impact_grid_display_all', FALSE);
      
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
* HTML for the Home Page Slide Show
* $style - style for the slide show, height and width if not default
*/
if (!function_exists('sf_impact_get_slideshow')):
    function sf_impact_get_slideshow($wstyle, $hstyle)
    {
        
          $format =  get_theme_mod('sf_impact_slider_style', 'default');
          $sf_impact_slider_captions = get_theme_mod('sf_impact_slider_captions', TRUE) ;
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
               
                     $sf_impact_slider_thumbnails = get_theme_mod('sf_impact_slider_thumbnails', false) == TRUE ? "true" : "false";
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
                 	            <li <?php echo $datathumb?>>
		    		            <a href="<?php echo $permalink ?>"><img src="<?php echo $image_url?>" alt="<?php echo $hid?>" <?php echo $fhstyle; ?>/>
                                <?php if ($sf_impact_slider_captions==true) { ?>
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
        $full  = sf_impact_postContentFull();
    

        if ( $the_query->have_posts() ) :  ?>
        <div>
  		<?php /* Start the Loop */ ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
               <?php
                $current_post_index = $the_query->current_post ;   //Get the current index
                $full  = sf_impact_postContentFull();  //Check to see if the option to display excerpts is on or off
                $sf_impact_show_full_sticky_post = FALSE;  //Check to see if the sticky as full post option is on 
                if (is_sticky() && !$full)  //The sticky as full post is only valid when excerpts are enabled.
                   $sf_impact_show_full_sticky_post = (get_theme_mod('sf_impact_show_full_sticky_post', true) && $current_post_index  == 0);      //Make sure that all sticky posts at the top display as full if this is set
                ?>      
			<?php
                if ($full || get_post_format() == "link")
				    get_template_part( 'template-parts/content', get_post_format() );
                else
                    if ($sf_impact_show_full_sticky_post)
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

?>

