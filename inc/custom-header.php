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
	add_theme_support( 'custom-header', apply_filters( 'sf_impact_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/images/impact.png',
		'default-text-color'     => '000276',
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
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
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
