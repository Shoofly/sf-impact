<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package shoofly
 * @subpackage sf-impact
 * @since sf-impact 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
function sf_impact_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'sf_impact_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function sf_impact_jetpack_setup
add_action( 'after_setup_theme', 'sf_impact_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function sf_impact_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function sf_impact_infinite_scroll_render
