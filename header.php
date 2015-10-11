<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
    wp_head();
    $reghead = TRUE;
    $url = get_header_image();        //get the default header image
    $sf_impact_post_header = get_theme_mod('sf_impact_post_header', false);
    $sf_impact_post_featured = get_theme_mod('sf_impact_post_featured', true);
    //If this is a post check to see if the option to use the featured image as the header is set and IF there is a
    //featured image, use that instead of the default wordpress header
 
    if (is_single() && $sf_impact_post_header && $sf_impact_post_featured)
    {
             $image_id = get_post_thumbnail_id();
             $image_atts = wp_get_attachment_image_src($image_id, "full", true);
             if (isset($image_atts) && $image_atts[1] >= HEADER_IMAGE_WIDTH ) 
                $url = $image_atts[0] ; //Replace the default header
    } 
    
                     
    //Get the settings for the header
    $sf_impact_logo_location = get_theme_mod('sf_impact_logo_location', 'image');
    $sf_impact_menu_location = get_theme_mod('sf_impact_menu_location', 'above');
    $sf_impact_home_header_type = get_theme_mod('sf_impact_home_header_type', '3');
    $sf_impact_header_image = get_theme_mod('sf_impact_header_image', '');
    $sf_impact_social_above_content = get_theme_mod('sf_impact_social_above_content', true);
    $sf_impact_social_above_menu = get_theme_mod('sf_impact_social_above_menu', false);
    //Is this the home page or the front page (and not the blog page) and the header type is not default display the custom home page header image/slide show
    if ((is_home() || is_front_page()) && $sf_impact_home_header_type != "3" && !$wp_query -> is_posts_page)
        $homeimage = TRUE;      //Display the custom home page header
    else
        $homeimage = FALSE;     //Do not display the custom home page header
    
    $logo = $sf_impact_logo_location; 
    $menu = $sf_impact_menu_location;
    $the_slide_query  = NULL;
    $noheaderimg = FALSE;

    if ($homeimage) //This check is only going to happen for the home page or the front page
    {
        $noheaderimg = FALSE;
        switch ($sf_impact_home_header_type)
        {
            default:
            case NOHEADER:
                $noheaderimg = TRUE;
                break;
            case DEFAULTHEADER:
                if ($url == "")
                    $noheaderimg = TRUE;
                break;
            case CUSTOMHEADER:
                 if ($sf_impact_header_image=="")
                    $noheaderimg = TRUE;
                break;
            case SLIDEHEADER:
                $the_slide_query = sf_impact_slideshow_query(); //Make sure that there are slides
               
                if ($the_slide_query->post_count <= 0)
                { 
            
                    $sf_impact_home_header_type = 2;
                    $noheaderimg = TRUE;
                    $the_slide_query = NULL;
                }
                break;
        }
    } 
     elseif (!$url) { //This check only occurs on pages that are not the front page or home page 
        $noheaderimg = TRUE;
    }
    if ($noheaderimg)
    {
        $logo="top";
        $menu = "above";
        
    }      
?>

<body <?php body_class();?>><div id="page" class="hfeed site  clear">
	
       
        <div id="topmasthead" class="fixed"> <!-- navigatin area -->
            <div id="containermasthead">
                <?php if ($sf_impact_social_above_menu) sf_impact_social_media_icons();?> 
            <div id="outermasthead">
            
                <div id="innermasthead" class="fixed">
                <?php
                if ($logo == "top")   //If the logo or title is on top, display it here 
                {
                    ?>
                    <div class="site-branding fixed" >
                    <?php
                    get_template_part('template-parts/branding');
                    ?>
                    </div>               
                <?php
            
                }?>
  
                <?php if ($menu == "above")
                    sf_impact_menu();
                ?>
 	    
                   
                </div><!--innermasthead-->
        </div>
            </div>
        </div><!--topmasthead-->
 	<header id="masthead" class="site-header" role="banner">
        <?php
        if ($homeimage === TRUE)
            $xClass="sfly-headerimg-home";
        else
            $xClass = "";
        ?>
            
        <div class="sfly-headerimg <?php echo $xClass; ?>">
            <?php    
             if ($logo=="image")
            {?>
                <div class="site-branding fixed shoofly-branding-image" >
                    <?php get_template_part('template-parts/branding');?>
		        </div>
             <?php 
            }
            if (!$homeimage) //If this is not the home image or the front page, display the url
            {
                if ( $url )
                {
                    ?>
            
                    <img class="headerimg headerimg-page" src="<?php echo $url ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
                <?php  
                }
            }
            else
            {
                sf_impact_header($sf_impact_home_header_type, $sf_impact_header_image, $sf_impact_logo_location, $the_slide_query );
            }
    
        ?>
        </div><!--sfly-headerimg-->
        <?php if ($menu == "below")
        {
                sf_impact_menu();
            ?><hr class="navdivider"><?php
         }
        ?>

         <?php

         if ((is_home() || is_front_page()) && !$wp_query -> is_posts_page)
         {
            if ( get_theme_mod('sf_impact_home_featured_highlights', false))
            {
            ?>
 
                <div id="sfly-home-header">
                    <?php  sf_impact_get_highlightboxes();  //DISPLAY FEATURED HIGHLIGHT BOXES?>
                </div><!--sfly-home-header-->
            <?php
            }
         }      
        if (sf_impact_is_grid())
        {
               
            ?> <div class="sfly-grid">
          <?php
            $arra = sf_impact_get_thumbnailarray();  //Get the settings for the thumbnail grid
            $url = sf_impact_get_thumbnailurl();     //Get the url for the read more link
            $sf_impact_grid_title =  get_theme_mod('sf_impact_grid_title', 'Recent Posts');
            $sf_impact_grid_more = get_theme_mod('sf_impact_grid_more', 'More Recent Posts')        
                ?>
            <div class="home-thumb fixed">
                <h1><?php echo $sf_impact_grid_title  ?></h1>
                <?php 
                $tg = new sfly_thumbnailgrid();
                echo  $tg->thumbnailgrid_function($arra);?> 
                <div class="more-link"><a href="<?php echo $url?>"><?php echo $sf_impact_grid_more?></a></div>
                </div>
            <hr>
            </div>
                <?php
        }
        ?>
	</header><!-- #masthead -->
    
	<div id="content" class="site-content">
     <?php if ($sf_impact_social_above_content) sf_impact_social_media_icons(); ?>     