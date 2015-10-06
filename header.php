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
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php 
    wp_head(); 
    $url = (get_header_image());        //get the default header image
    //Get the settings for the header
    $sf_impact_logo_location = get_theme_mod('sf_impact_logo_location', 'image');
    $sf_impact_menu_location = get_theme_mod('sf_impact_menu_location', 'below');
    $sf_impact_home_header_type = get_theme_mod('sf_impact_home_header_type', '3');
    $sf_impact_header_image = get_theme_mod('sf_impact_header_image', '');
    $sf_impact_social_above_content = get_theme_mod('sf_impact_social_above_content', true);
    $sf_impact_social_above_menu = get_theme_mod('sf_impact_social_above_menu', false);
    $sf_impact_thumbnail_more_page = get_theme_mod('sf_impact_thumbnail_more_page', '');
    //Is this the home page or the front page (and not the blog page) and the header type is not default display the custom home page header image/slide show
    if ((is_home() || is_front_page()) && $sf_impact_home_header_type != "3" && !$wp_query -> is_posts_page)
        $homeimage = TRUE;      //Display the custom home page header
    else
        $homeimage = FALSE;     //Do not display the custom home page header
    $logo = $sf_impact_logo_location; 
    $menu = $sf_impact_menu_location;
    if ($homeimage && $sf_impact_home_header_type != 2 && !$sf_impact_header_image ) //Make sure there is an image to post it on
    {
        $logo = "top"; //No Header Image
        $menu = "above";                     
    }
    if (!$homeimage && !$url)     
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
                    sf_impact_light_menu();
                ?>
 	    
                   
                </div><!--innermasthead-->
        </div>
            </div>
        </div><!--topmasthead-->
 	<header id="masthead" class="site-header" role="banner">
        <?php
        if ($homeimage)
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
             if (!$homeimage)
            {
                
                if ( $url )
                {
                    ?>
            
                    <img class="headerimg headerimg-page" src="<?php echo header_image() ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
                <?php  
                }
            }
            else
            {
                sf_impact_homeheader(); /*code to display header on home page*/
              
            }
    
        ?>
        </div><!--sfly-headerimg-->
        <?php if ($menu == "below")
        {
                sf_impact_light_menu();
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
            $sf_impact_grid_more = get_theme_mod( 'sf_impact_grid_more', 'More');
            $sf_impact_grid_display = get_theme_mod('sf_impact_grid_display', FALSE);
            $sf_impact_grid_display_all = get_theme_mod('sf_impact_grid_display_all', FALSE);
            $sf_impact_grid_title = get_theme_mod( 'sf_impact_grid_title', "Recent Posts");
            $sf_impact_grid_type = get_theme_mod('sf_impact_grid_type', 'post');
    
            $sf_impact_grid_posts = get_theme_mod( 'sf_impact_grid_posts', '4');
            $sf_impact_grid_image_height = get_theme_mod( 'sf_impact_grid_image_height',"" );
            $sf_impact_grid_image_width= get_theme_mod( 'sf_impact_grid_image_width',"" );
            $sf_impact_grid_cell_width = get_theme_mod( 'sf_impact_grid_cell_width',  "" );
            $sf_impact_grid_cell_height = get_theme_mod( 'sf_impact_grid_cell_height', "");
            $sf_impact_post_category = get_theme_mod( 'sf_impact_post_category', "");
            $sf_impact_image_size_name = get_theme_mod( 'sf_impact_image_size_name', 'thumbnail');

            $arra = sf_impact_get_thumbnailarray($sf_impact_grid_type, $sf_impact_post_category, $sf_impact_grid_posts, $sf_impact_grid_image_height, $sf_impact_grid_image_width,  $sf_impact_image_size_name, $sf_impact_grid_cell_width, $sf_impact_grid_cell_height, $sf_impact_grid_image_width, "99%");
            $url = sf_impact_get_thumbnailurl($sf_impact_post_category, $sf_impact_thumbnail_more_page);
                    
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