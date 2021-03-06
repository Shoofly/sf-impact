<?php
/**
 * The template for displaying Author bios
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
 global $sf_impact_Theme_Mods;
?>

<div class="author-info">
	<h2 class="author-heading"><?php _e( 'Published by', 'sf-impact' ); ?></h2>
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Twenty Fifteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'sf_impact_author_bio_avatar_size', 56 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );

		?>
        <h3 class="author-title"><?php echo get_the_author(); ?></h3>
	</div><!-- .author-avatar -->

	<div class="author-description">
		

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>

		</p><!-- .author-bio -->

	</div><!-- .author-description -->
     <div class="author-links">			
        <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
    			<?php printf( __( 'View all posts by %s', 'sf-impact' ), get_the_author() ); ?>
        </a>
    </div>
</div><!-- .author-info -->
