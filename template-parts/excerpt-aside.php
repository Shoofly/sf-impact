<?php
/**
* Template part for displaying aside excerpt posts.
 * @package shoofly
  * @subpackage sfimpact
 * @since sfImpact 1.0
 */
global $sf_impact_Theme_Mods; 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
 <hr>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content entry-excerpt">
 		<?php
           $sf_impact_show_thumbnail_excerpt = $sf_impact_Theme_Mods->getMod('sf_impact_show_thumbnail_excerpt');
            if (has_post_thumbnail() && $sf_impact_show_thumbnail_excerpt != FALSE)
            {
                the_post_thumbnail( 'thumbnail' ); 
            }
    		the_content( );

		?>
	</div><!-- .entry-content -->
 </article> 