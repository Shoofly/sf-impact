<?php
/**
* Template part for displaying excerpt posts.
 * @package shoofly
  * @subpackage sfimpact
 * @since sfImpact 1.0
 */
 
?>
 <hr>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     <header class="entry-header">
          	<div class="entry-meta">
    			<?php sf_impact_lite_posted_on(); ?>
		    </div><!-- .entry-meta -->
            <?php sf_impact_lite_title(); ?>
     </header><!-- .entry-header -->
    <div class="entry-content entry-excerpt">
 		<?php
           $sf_impact_lite_show_thumbnail_excerpt = get_theme_mod('sf_impact_lite_show_thumbnail_excerpt', FALSE);
            if (has_post_thumbnail() && $sf_impact_lite_show_thumbnail_excerpt != FALSE)
            {
                the_post_thumbnail( 'thumbnail' ); 
            }
    		the_excerpt( );
            wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'sfimpact' ),
			'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
 </article>
 