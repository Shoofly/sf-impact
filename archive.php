<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

get_header(); ?>
<div id="container">
    
  <div id="wrap" class="archive-page">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
	    			the_archive_title( '<h1 class="page-title archive-title">', '</h1>' );
						
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); 
                $full  = sf_impact_postContentFullPage();
                if ($full)
				    get_template_part( 'template-parts/content', get_post_format() );
                else
                    get_template_part('template-parts/excerpt', get_post_format());
				?>

			<?php endwhile; ?>
             
			<?php the_posts_navigation(); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
       
		</main><!-- #main -->
	</div><!-- #primary -->
     <?php get_sidebar(); ?>
  </div><!--wrap-->
</div><!--container-->

<?php get_footer(); ?>
