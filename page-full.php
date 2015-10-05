<?php
/**
 * Template Name: Full Width Page (No sidebar)
 * @package _shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */

get_header(); 

$indexClass="site-main fullpage";

?>
<div id="container">

  <div id="wrap" class="page-full">
    <div id="primary" class="<?php $indexClass; ?>">
	    <div id="main" class="<?php $indexClass; ?> content_16" role="main">

	    <?php if ( have_posts() ) : ?>

		    <?php /* Start the Loop */ ?>
		    <?php while ( have_posts() ) : the_post(); ?>
           
			    <?php
				
				    get_template_part( 'template-parts/content', 'full' );
			    ?>

		    <?php endwhile; ?>

		    <?php the_posts_navigation(); ?>
	    <?php else : ?>
		    <?php get_template_part( 'content', 'none' ); ?>

	    <?php endif; ?>

	    </div><!-- #main -->
    </div><!-- #primary -->
  </div><!--wrap-->
</div><!--container-->
<?php
get_footer(); 
?>
