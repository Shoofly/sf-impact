<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
 defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 global $sf_impact_Theme_Mods;
get_header(); 
//default sidebar option
$sf_impact_post_sidebar = !$sf_impact_Theme_Mods->getMod('sf_impact_post_sidebar');
//post sidebar option
$val = esc_attr( get_post_meta( $post->ID, 'post_hide_sidebar', true ) );
$hidesidebar =  isset($val) ? $val : $sf_impact_post_sidebar ;
$postclass = "single-format single-format-" . get_post_format( $post->post_id );
if (!$hidesidebar)
    $class="content-area";
else
    $class="content-area content-area-full";
?>
<div id="container">

  <div id="wrap" class="<?php echo $postclass; ?>">
	<div id="primary" class="<?php echo $class; ?>">
		<main id="main" class="site-main" role="main">
         
		<?php while ( have_posts() ) : the_post(); 

			get_template_part( 'template-parts/content', get_post_format() );

			 the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <?php if (!$hidesidebar)
        get_sidebar(); ?>
   </div><!--wrap-->
</div><!--containter-->
<?php get_footer(); ?>
