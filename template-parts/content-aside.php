<?php
/**
 * Template part for displaying aside posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 	    <div class="entry-content entry-aside">
 	        <header class="entry-header">
	  	        <div class="entry-meta">
			    <?php sf_impact_lite_posted_on(); ?>
		        </div><!-- .entry-meta -->
            </header><!-- .entry-header --><?php
            the_content(get_theme_mod('sf_impact_lite_excerpt_more_text', 'Read the rest') ,
				    the_title( '<span class="screen-reader-text">', '</span>', false ));
     	    wp_link_pages( array(
				    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact-lite' ),
				    'after'  => '</div>',
			    ) );
		    ?>
	    </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php sf_impact_lite_entry_footer(); ?>
	    </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
<?php

