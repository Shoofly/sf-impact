<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
  defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 global $sf_impact_Theme_Mods;
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <?php sf_impact_thumbnail();?>
	     <header class="entry-header">
	  	        <div class="entry-meta">
			        <?php sf_impact_posted_on(); ?>
		        </div><!-- .entry-meta -->
                  <?php sf_impact_title(); ?>
          </header><!-- .entry-header -->
	


	    <div class="entry-content entry-video">
		    <?php
			    /* translators: %s: Name of current post */
			    the_content( sprintf(
				    __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'sf-impact' ),
				    the_title( '<span class="screen-reader-text">', '</span>', false )
			    ) );
            
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