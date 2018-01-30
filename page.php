<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
global $sf_impact_Theme_Mods;
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
get_header(); 
  $sf_impact_home_sidebar = $sf_impact_Theme_Mods->getMod('sf_impact_home_sidebar');
 
  $sidebar = TRUE;
 if (!$sf_impact_home_sidebar && is_front_page())
 {
    
        $class="full-width";
        $sidebar = FALSE;
 }
    else
        $class="";
 ?>
<div id="container">
  
  <div id="wrap" class="page-default">
	<div id="primary" class="content-area <?php echo $class?>">
		<main id="main" class="site-main" role="main">
            <?php if (!is_front_page()) sf_impact_thumbnail();?>
			<?php 
    		if ( !is_front_page() || !is_active_sidebar('homepage-sidebar-left') ):	
    			while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
            	<?php the_posts_navigation(); ?>
			<?php endwhile; // End of the loop.
            else:
                dynamic_sidebar( 'homepage-sidebar-left' );
            endif;  ?>

		</main><!-- #main -->
	</div><!-- #primary -->
      <?php  if ($sidebar)
       get_sidebar(); 
       
       if ( is_front_page() && is_active_sidebar('homepage-sidebar-left') ):
    			while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
            	<?php the_posts_navigation(); ?>
			<?php endwhile; // End of the loop.            
       endif;
       ?>
  </div><!--wrap-->
</div><!--container-->

<?php get_footer(); ?>
