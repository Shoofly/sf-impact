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
global $sf_impact_Theme_Mods;

?>
 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
       <?php wp_head(); ?>
    </head>
    
<?php 
  
    $reghead = TRUE;
    $url = get_header_image();        //get the default header image
    
    //If this is a post check to see if the option to use the featured image as the header is set and IF there is a

    //featured image, use that instead of the default wordpress header
    if (is_single()  || (is_page() && !is_front_page()))
    {
        $url = sf_impact_getCustomUrl($url);    
  
    }
                
    //Get the settings for the header
    $sf_impact_logo_location = $sf_impact_Theme_Mods->getMod('sf_impact_logo_location');
    $sf_impact_menu_location = $sf_impact_Theme_Mods->getMod('sf_impact_menu_location');
    $sf_impact_home_header_type = $sf_impact_Theme_Mods->getMod('sf_impact_home_header_type');
    $sf_impact_header_image = $sf_impact_Theme_Mods->getMod('sf_impact_header_image');
    $sf_impact_social_above_content = $sf_impact_Theme_Mods->getMod('sf_impact_social_above_content');
    $sf_impact_social_above_menu = $sf_impact_Theme_Mods->getMod('sf_impact_social_above_menu');
    //Is this the front page (and not the blog page) and the header type is not default display the custom home page header image/slide show
    if (( is_front_page()) && $sf_impact_home_header_type != "3") {// && !$wp_query -> is_posts_page) {
        $homeimage = TRUE;      //Display the custom home page header
    } else {
        $homeimage = FALSE;     //Do not display the custom home page header
    }
    
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
            case SF_IMPACT_NOHEADER:
                $noheaderimg = TRUE;
                break;
            case SF_IMPACT_DEFAULTHEADER:
                if ($url == "")
                    $noheaderimg = TRUE;
                break;
            case SF_IMPACT_CUSTOMHEADER:
                 if ($sf_impact_header_image=="")
                    $noheaderimg = TRUE;
                break;
            case SF_IMPACT_SLIDEHEADER:
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

<body <?php if (sf_impact_page_bbpress()) body_class('forum'); else body_class();?>><div id="page" class="hfeed site  clear">
	
       
        <div id="topmasthead" class="fixed"> <!-- navigatin area -->
            <div id="containermasthead">
                <?php 
                /*************************************Top Social Media Icons*******************************/    
                if ($sf_impact_social_above_menu) sf_impact_social_media_icons();
                /***************************************Menu styling**************************************/
                $bottom = FALSE;
                //future enhancement
                /*    if ($logo == "top" && $menu == "above"){  //If the logo or title is on top, display it here 
                        $bottom = $sf_impact_Theme_Mods->getMod('sf_impact_align_menu') ? TRUE : false; 
                }*/?>
                <div id="outermasthead" <?php echo $bottom ? "class='nav_bottom'" : ''; ?>>
           
                    <?php /******************************************Top Branding Above Header**********************************/
                    ?>
                    <div id="innermasthead" class="fixed">
                        <?php 
                        if ($logo == "top"):   //If the logo or title is on top, display it here 
                        ?><div class="site-branding fixed">
                           <?php get_template_part('template-parts/branding');?>
                        </div><?php
                        endif;
                        /********************************************Menu Above Header*******************************/
                        if ($menu == "above"):
                            sf_impact_menu();
                        endif;
                        ?>           
                    </div><!--innermasthead-->
                </div><!--outermasthead-->
            </div><!--containermasthead-->
        </div><!--topmasthead-->
        
     	<header id="masthead" class="site-header" role="banner">
            <?php
            
            /*********************************Logo On Top of Image************************/    
            ?>
             
            <div class="sfly-headerimg <?php echo $homeimage == true ? 'sfly-headerimg-home' : ''; ?> fixed">
                <?php if ($logo=="image"): ?>
                    <div class="site-branding fixed shoofly-branding-image" >
                        <?php get_template_part('template-parts/branding');?>
                    </div>
                 <?php endif;
                /**********************Display The Header************************************/
                //If this is not the home image or the front page, display the url
                if (!$homeimage) {
                    if ( $url ): ?>
                        <div class="header-container-inner">
                            <img class="headerimg headerimg-page" src="<?php echo esc_url($url); ?>" alt="header" >
                        </div>
                    <?php
                    endif;
                } else {
                //This is some kind of custom Header
                    sf_impact_header($sf_impact_home_header_type, $sf_impact_header_image, $sf_impact_logo_location, $the_slide_query, $logo );
                }
              /*************************Menu below header area******************************/     
            ?>
 
            </div><!--sfly-headerimg-->
            <?php 
            if ($menu == "below") {
                    sf_impact_menu();
                ?><hr class="navdivider"><?php
            }
            /*****************************customize filter for You**************************/
            do_action('sf_impact_after_header');
            /******************************Sidebar Below Header*****************************/
            ?>
           <?php //sidebar
                if ( is_front_page() ) {
                   get_sidebar('header');
            	}
        	?>   
             <?php
            /*****************************Featured Highlight area***************************/
            if ((is_front_page()) && !$wp_query -> is_posts_page) { //do not show on blog page
                if ( $sf_impact_Theme_Mods->getMod('sf_impact_home_featured_highlights')) {
                ?>
     
                    <div id="sfly-home-header">
                        <?php  sf_impact_get_highlightboxes();  //DISPLAY FEATURED HIGHLIGHT BOXES?>
                    </div><!--sfly-home-header-->
                <?php
                }
            }      
            /*********************************Thumbnail Grid Area**********************************/
            if (sf_impact_is_grid()) {
                   
                ?> <div class="sfly-grid">
              <?php
                $arra = sf_impact_get_thumbnailarray();  //Get the settings for the thumbnail grid
                $url = sf_impact_get_thumbnailurl();     //Get the url for the read more link
                $sf_impact_grid_title =  $sf_impact_Theme_Mods->getMod('sf_impact_grid_title');
                $sf_impact_grid_more = $sf_impact_Theme_Mods->getMod('sf_impact_grid_more')        
                    ?>
                <div class="home-thumb fixed">
                    <h1><?php echo esc_attr($sf_impact_grid_title)  ?></h1>
                    <?php 
                    $tg = new thumbnailgrid($arra);
                    echo  $tg->thumbnailgrid_function();?> 
                    <div class="more-link"><a href="<?php echo esc_url($url)?>"><?php echo $sf_impact_grid_more?></a></div>
                    </div>
                <hr>
                </div>
                    <?php
            }
            ?>
    	</header><!-- #masthead -->
    	<div id="content" class="site-content">
        <?php 
        /***********************************Social Icons Above Content****************************************************/
        if ($sf_impact_social_above_content):
              sf_impact_social_media_icons();
        endif;
        /************************************Customize filter for your stuff here**************************************************/
        do_action('sf_impact_before_content');