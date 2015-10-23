<?php
/**
 * Custom Header feature.
 *
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses sf_impact_header_style()
 * @uses s_admin_header_style()
 * @uses s_admin_header_image()
 */
   
function sf_impact_custom_header_setup() {
     global $sf_impact_Theme_Mods;
	add_theme_support( 'custom-header', apply_filters( 'sf_impact_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/images/impact.png',
		'default-text-color'     =>  $sf_impact_Theme_Mods->getDefault('sf_impact_header_textcolor'),  
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'sf_impact_header_style',
		'admin-head-callback'    => 'sf_impact_admin_header_style',
		'admin-preview-callback' => 'sf_impact_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'sf_impact_custom_header_setup' );

if ( ! function_exists( 'sf_impact_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see sf_impact_custom_header_setup().
 */
function sf_impact_header_style() {
     global $sf_impact_Theme_Mods;
	$header_text_color = get_header_textcolor();
}
endif; // sf_impact_header_style

if ( ! function_exists( 'sf_impact_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see sf_impact_custom_header_setup().
 */
function sf_impact_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // sf_impact_admin_header_style

if ( ! function_exists( 'sf_impact_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see sf_impact_custom_header_setup().
 */
function sf_impact_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // sf_impact_admin_header_image
?>