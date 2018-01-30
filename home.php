<?php
/**
 * The home template file.
 *
  *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

// Header
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
get_header();
global $sf_impact_Theme_Mods;

//Home Page
   $sf_impact_home_posts = $sf_impact_Theme_Mods->getMod('sf_impact_home_posts'); 
    $sf_impact_home_sidebar = $sf_impact_Theme_Mods->getMod('sf_impact_home_sidebar');
    if ($sf_impact_home_sidebar == FALSE)
        $class="full-width";
    else
        $class="";
 
  ?>
    <?php wp_reset_postdata(); ?>
    <div id="container">

        <div id="wrap" class="home">
          
	        <div id="primary" class="content-area fixed <?php echo $class?>">
                  <?php get_sidebar('main'); ?>
                <main id="main" class="site-main" role="main">

                    <?php 
               

                    if ($sf_impact_home_posts) {  
                        $sf_impact_home_rp_categoryid = $sf_impact_Theme_Mods->getMod('sf_impact_home_rp_categoryid'); 
                    
                
                        if ($sf_impact_home_rp_categoryid != "" && $sf_impact_home_rp_categoryid != "0"  ) {
                            
                                sf_impact_posts_by_category($sf_impact_home_rp_categoryid);
                                         
                        } else {
                            sf_impact_home_query();
                        }
                   
                        wp_reset_postdata(); 
                    }
                    else { ?>
                        <div style="visibility: hidden">&nbsp;</div>
                    <?php } ?>                
                </main>
	        </div>  <!-- #primary (left)-->
            <!--secondary (right)-->
            <?php if ($sf_impact_home_sidebar != FALSE)  get_sidebar();  ?>
    
        </div><!--wrap-->
    </div> <!--container-->
          <?php         
     get_footer(); ?>
 
