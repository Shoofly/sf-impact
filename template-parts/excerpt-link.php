<?php
/**
* Template part for displaying excerpt posts.
 * @package shoofly
  * @subpackage sfimpact
 * @since sfImpact 1.0
 */
global $sf_impact_Theme_Mods;
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$myLink = sf_impact_get_url(); 
if (!$myLink) $post_format = "standard";

if (!$myLink)
     get_template_part('template-parts/excerpt');
			
?>
 <hr>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     <header class="entry-header">
        <h2 class="entry-title">
            <a href="<?php echo esc_url($myLink); ?>"><?php echo the_title(); ?></a>
        </h2>
     </header><!-- .entry-header -->
    <div class="entry-content entry-excerpt">

		<?php
             $sf_impact_show_thumbnail_excerpt = $sf_impact_Theme_Mods->getMod('sf_impact_show_thumbnail_excerpt');
       
            if (has_post_thumbnail() && $sf_impact_show_thumbnail_excerpt != FALSE)
            {
                the_post_thumbnail( 'thumbnail' ); 
            }
            
            
		?>
      
	</div><!-- .entry-content -->
 </article>
 