<?php
/*
 * Template part for displaying posts.
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 * default content
 */
 global $sf_impact_Theme_Mods;
 defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 global $isarchiveshortcode;  //if archive shortcode, skip this

 
        ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php sf_impact_thumbnail();?>
       
	    <header class="entry-header">
              
	  	        <div class="entry-meta">
			        <?php sf_impact_posted_on(); ?>
		        </div><!-- .entry-meta -->
       
                <?php sf_impact_title(); ?>
        </header><!-- .entry-header -->
 
	    <div class="entry-content entry-content-full">

            <?php
            the_content($sf_impact_Theme_Mods->getMod('sf_impact_excerpt_more_text'));	
	        wp_link_pages( array(
				    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact' ),
				    'after'  => '</div>',
			    ) );
		    ?>
	    </div><!-- .entry-content -->
       
        <footer class="entry-footer">
		        <?php sf_impact_entry_footer(); ?>
   
	    </footer><!-- .entry-footer -->
       
    </article>