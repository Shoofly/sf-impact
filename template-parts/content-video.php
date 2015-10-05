<?php
/**
 * The template for displaying posts in the Video post format
 *
 * @package shoofly
 * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 */
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <?php sf_impact_lite_thumbnail();?>
	     <header class="entry-header">
	  	        <div class="entry-meta">
			        <?php sf_impact_lite_posted_on(); ?>
		        </div><!-- .entry-meta -->
                  <?php sf_impact_lite_title(); ?>
          </header><!-- .entry-header -->
	


	    <div class="entry-content entry-video">
		    <?php
			    /* translators: %s: Name of current post */
			    the_content( sprintf(
				    __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'sf-impact-lite' ),
				    the_title( '<span class="screen-reader-text">', '</span>', false )
			    ) );
            
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