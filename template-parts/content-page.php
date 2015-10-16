<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    <header class="entry-header">
	  	    <div class="entry-meta">
			    <?php //sf_impact_posted_on(); ?>
		    </div><!-- .entry-meta -->
              <?php sf_impact_title(); ?>
      </header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
        the_content(get_theme_mod('sf_impact_excerpt_more_text', 'Read the rest'));	
	    wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php sf_impact_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

