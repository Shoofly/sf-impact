<?php
/*
 * Template part for displaying posts.
 * @package shoofly
  * @subpackage sf-impact
 * @since sf-impact 1.0
 * default content
 */
   global $more;
    $more = 0;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php sf_impact_thumbnail();?>
       
	        <header class="entry-header">
  
                 <?php sf_impact_title(); ?>
            </header><!-- .entry-header -->
 
	    <div class="entry-content entry-content-full">

            <?php

            the_content();	
	        wp_link_pages( array(
				    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sf-impact' ),
				    'after'  => '</div>',
			    ) );
		    ?>
	    </div><!-- .entry-content -->
 </article>