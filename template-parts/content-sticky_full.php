<?php
/*
 * Template part for displaying sticky posts above excerpts
 * @package shoofly
  * @subpackage sf-impact-lite
 * @since sf-impact-lite 1.0
 * default content
 */


?>


    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php sf_impact_lite_thumbnail();?>
       
	    <header class="entry-header">
                <?php sf_impact_lite_title(); ?>
        </header><!-- .entry-header -->
 
	    <div class="entry-content entry-content-sticky_full">

            <?php
            the_content(get_theme_mod('sf_impact_lite_excerpt_more_text', 'Read the rest'));	
	        wp_link_pages( array(
				    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact-lite' ),
				    'after'  => '</div>',
			    ) );
		    ?>
	    </div><!-- .entry-content -->

    </article>