<?php
/**
 * Genesis Sample.
 *
 * This file adds the required CSS to the front end to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_action( 'wp_enqueue_scripts', 'genesis_sample_css' );
/**
 * Checks the settings for the link color, and accent color.
 * If any of these value are set the appropriate CSS is output.
 *
 * @since 2.2.3
 */
function genesis_sample_css() {

	$appearance = genesis_get_config( 'appearance' );

	$color_link   = get_theme_mod( 'genesis_sample_link_color', $appearance['default-colors']['link'] );
	$color_primary = get_theme_mod( 'genesis_sample_primary_color', $appearance['default-colors']['primary'] );
	$color_accent = get_theme_mod( 'genesis_sample_accent_color', $appearance['default-colors']['accent'] );

	$logo         = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

	if ( $logo ) {
		$logo_height           = absint( $logo[2] );
		$logo_max_width        = get_theme_mod( 'genesis_sample_logo_width', 350 );
		$logo_width            = absint( $logo[1] );
		$logo_ratio            = $logo_width / max( $logo_height, 1 );
		$logo_effective_height = min( $logo_width, $logo_max_width ) / max( $logo_ratio, 1 );
		$logo_padding          = max( 0, ( 60 - $logo_effective_height ) / 2 );
	}

	$css = '';

	$css .= ( $appearance['default-colors']['link'] !== $color_link ) ? sprintf(
		'

		a,
		.entry-title a:focus,
		.entry-title a:hover {
			color: %s;
		}

		',
		$color_link
	) : '';

	$css .= ( $appearance['default-colors']['primary'] !== $color_primary ) ? sprintf(
		'

		body {
			color: %1$s;
		}
		',
		$color_primary,
		genesis_sample_color_contrast( $color_primary )
	) : '';


	$css .= ( $appearance['default-colors']['accent'] !== $color_accent ) ? sprintf(
		'

		button:focus,
		button:hover,
		input[type="button"]:focus,
		input[type="button"]:hover,
		input[type="reset"]:focus,
		input[type="reset"]:hover,
		input[type="submit"]:focus,
		input[type="submit"]:hover,
		input[type="reset"]:focus,
		input[type="reset"]:hover,
		input[type="submit"]:focus,
		input[type="submit"]:hover,
		.site-container div.wpforms-container-full .wpforms-form input[type="submit"]:focus,
		.site-container div.wpforms-container-full .wpforms-form input[type="submit"]:hover,
		.site-container div.wpforms-container-full .wpforms-form button[type="submit"]:focus,
		.site-container div.wpforms-container-full .wpforms-form button[type="submit"]:hover,
		.button:focus,
		.button:hover {
			background-color: %1$s;
			color: %2$s;
		}

		@media only screen and (min-width: 960px) {
			.genesis-nav-menu > .menu-highlight > a:hover,
			.genesis-nav-menu > .menu-highlight > a:focus,
			.genesis-nav-menu > .menu-highlight.current-menu-item > a {
				background-color: %1$s;
				color: %2$s;
			}
		}
		',
		$color_accent,
		genesis_sample_color_contrast( $color_accent )
	) : '';

	$css .= ( has_custom_logo() && ( 200 <= $logo_effective_height ) ) ?
		'
		.site-header {
			position: static;
		}
		'
	: '';

	$css .= ( has_custom_logo() && ( 350 !== $logo_max_width ) ) ? sprintf(
		'
		.wp-custom-logo .site-container .title-area {
			max-width: %spx;
		}
		',
		$logo_max_width
	) : '';

	// Place menu below logo and center logo once it gets big.
	$css .= ( has_custom_logo() && ( 600 <= $logo_max_width ) ) ?
		'
		.wp-custom-logo .title-area,
		.wp-custom-logo .menu-toggle,
		.wp-custom-logo .nav-primary {
			float: none;
		}

		.wp-custom-logo .title-area {
			margin: 0 auto;
			text-align: center;
		}

		@media only screen and (min-width: 960px) {
			.wp-custom-logo .nav-primary {
				text-align: center;
			}

			.wp-custom-logo .nav-primary .sub-menu {
				text-align: left;
			}
		}
		'
	: '';

	if ( $css ) {
		wp_add_inline_style( genesis_get_theme_handle(), $css );
	}

}
