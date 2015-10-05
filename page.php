<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */

get_header(); 
  $sf_impact_lite_home_sidebar = get_theme_mod('sf_impact_lite_home_sidebar', TRUE);
 
  $sidebar = TRUE;
 if (!$sf_impact_lite_home_sidebar && is_front_page())
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
        
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
            	<?php the_posts_navigation(); ?>
			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
      <?php  if ($sidebar)
       get_sidebar(); ?>
  </div><!--wrap-->
</div><!--container-->

<?php get_footer(); ?>
