<?php
/**
* Template part for displaying excerpt posts.
 * @package shoofly
  * @subpackage sfimpact
 * @since sfImpact 1.0
 */
 global $sf_impact_Theme_Mods;
?>
 <hr>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     <header class="entry-header">
          	<div class="entry-meta">
    			<?php sf_impact_posted_on(); ?>
		    </div><!-- .entry-meta -->
            <?php sf_impact_title(); ?>
     </header><!-- .entry-header -->
    <div class="entry-content entry-excerpt">
 		<?php
           $sf_impact_show_thumbnail_excerpt = $sf_impact_Theme_Mods->getMod('sf_impact_show_thumbnail_excerpt');
            if (has_post_thumbnail() && $sf_impact_show_thumbnail_excerpt != FALSE)
            {
                the_post_thumbnail( 'thumbnail' ); 
            }
    		the_excerpt( );
            wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'sf-impact' ),
			'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
 </article>
 