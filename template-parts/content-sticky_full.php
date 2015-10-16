<?php
/*
 * Template part for displaying sticky posts above excerpts
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 * default content
 */
 global $sf_impact_Theme_Mods;

?>


    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php sf_impact_thumbnail();?>
       
	    <header class="entry-header">
                <?php sf_impact_title(); ?>
        </header><!-- .entry-header -->
 
	    <div class="entry-content entry-content-sticky_full">

            <?php
            the_content($sf_impact_Theme_Mods->getMod('sf_impact_excerpt_more_text'));	
	        wp_link_pages( array(
				    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact' ),
				    'after'  => '</div>',
			    ) );
		    ?>
	    </div><!-- .entry-content -->

    </article>