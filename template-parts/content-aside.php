<?php
/**
 * Template part for displaying aside posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 	    <div class="entry-content entry-aside">
 	        <header class="entry-header">
	  	        <div class="entry-meta">
			    <?php sf_impact_posted_on(); ?>
		        </div><!-- .entry-meta -->
            </header><!-- .entry-header --><?php
            the_content($sf_impact_Theme_Mods->getMod('sf_impact_excerpt_more_text') ,
				    the_title( '<span class="screen-reader-text">', '</span>', false ));
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


