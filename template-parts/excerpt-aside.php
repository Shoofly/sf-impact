<?php
/**
* Template part for displaying aside excerpt posts.
 * @package shoofly
  * @subpackage sfimpact
 * @since sfImpact 1.0
 */
 
?>
 <hr>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content entry-excerpt">
 		<?php
           $sf_impact_lite_show_thumbnail_excerpt = get_theme_mod('sf_impact_lite_show_thumbnail_excerpt', FALSE);
            if (has_post_thumbnail() && $sf_impact_lite_show_thumbnail_excerpt != FALSE)
            {
                the_post_thumbnail( 'thumbnail' ); 
            }
    		the_content( );

		?>
	</div><!-- .entry-content -->
 </article>
 