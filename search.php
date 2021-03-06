<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package shoofly
 * @subpackage sfimpact
 * @since sfImpact 1.0
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 global $sf_impact_Theme_Mods;
get_header(); ?>
<div id="container">

  <div id="wrap" class="search">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'sf-impact' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/excerpt', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
        <hr>
		</main><!-- #main -->
	</section><!-- #primary -->
      <?php get_sidebar(); ?>
  </div><!--wrap-->
</div><!--container-->

<?php get_footer(); ?>
