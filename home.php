<?php
/**
 * The home template file.
 *
  *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */

// Header
get_header();

//Home Page
   $sf_impact_lite_home_posts = get_theme_mod('sf_impact_lite_home_posts', true); 
    $sf_impact_lite_home_sidebar = get_theme_mod('sf_impact_lite_home_sidebar', TRUE);
    if ($sf_impact_lite_home_sidebar == FALSE)
        $class="full-width";
    else
        $class="";
    ?>

    <?php wp_reset_postdata(); ?>
    <div id="container">

        <div id="wrap" class="home">
       
	        <div id="primary" class="content-area fixed <?php echo $class?>">
                <main id="main" class="site-main" role="main">
                    <?php if ($sf_impact_lite_home_posts){ ?>  
                    <?php $sf_impact_lite_home_rp_categoryid = get_theme_mod('sf_impact_lite_home_rp_categoryid', "");
                   
                    //if ($sf_impact_lite_home_rp_categoryid != "") add_action( 'pre_get_posts', 'sf_impact_lite_home_category' );   ?>
                    <?php if ($sf_impact_lite_home_rp_categoryid != "" && $sf_impact_lite_home_rp_categoryid != "0"  )
                    {
                        sf_impact_lite_posts_by_category($sf_impact_lite_home_rp_categoryid);
                                     
                    }
                    else
                    {
                        sf_impact_lite_home_query();
                    }
                
                   
                    wp_reset_postdata(); ?>
                    <?php }
                    else { ?>
                    <div style="visibility: hidden">&nbsp;</div>
                    <?php } ?>                
                </main>
	        </div>  <!-- #primary -->
            
            <?php   if ($sf_impact_lite_home_sidebar != FALSE)  get_sidebar();  ?>
 
        </div><!--wrap-->
    </div> <!--container-->
          <?php         
     get_footer(); ?>
 
