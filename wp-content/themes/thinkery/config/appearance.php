<?php
/**
 * Genesis Sample appearance settings.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

$genesis_sample_default_colors = [
	'link'   => '#0073e5',
	'primary'   => '#1b2432',
	'accent' => '#0073e5',
];

$genesis_sample_link_color = get_theme_mod(
	'genesis_sample_link_color',
	$genesis_sample_default_colors['link']
);

$genesis_sample_primary_color = get_theme_mod(
	'genesis_sample_primary_color',
	$genesis_sample_default_colors['primary']
);

$genesis_sample_accent_color = get_theme_mod(
	'genesis_sample_accent_color',
	$genesis_sample_default_colors['accent']
);

$genesis_sample_link_color_contrast   = genesis_sample_color_contrast( $genesis_sample_link_color );
$genesis_sample_link_color_brightness = genesis_sample_color_brightness( $genesis_sample_link_color, 35 );

return [
	'fonts-url'            => 'https://use.typekit.net/kkn7rhy.css',
	'content-width'        => 1100,
	'site-header-bg'       => $genesis_sample_link_color,
	'button-bg'            => $genesis_sample_link_color,
	'button-color'         => $genesis_sample_link_color_contrast,
	'button-outline-hover' => $genesis_sample_link_color_brightness,
	'link-color'           => $genesis_sample_link_color,
	'default-colors'       => $genesis_sample_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Thinkery Red', 'genesis-sample' ),
			'slug'  => 'thinkery-red',
			'color' => '#c6101c',
		],
		[
			'name'  => __( 'Thinkery Dark Red', 'genesis-sample' ),
			'slug'  => 'thinkery-dark-red',
			'color' => '#970c15',
		],
		[
			'name'  => __( 'Thinkery Blue', 'genesis-sample' ),
			'slug'  => 'thinkery-blue',
			'color' => '#0d7bc5',
		],
		[
			'name'  => __( 'Thinkery Green', 'genesis-sample' ),
			'slug'  => 'thinkery-green',
			'color' => '#1d8725',
		],
		[
			'name'  => __( 'Thinkery Pink', 'genesis-sample' ),
			'slug'  => 'thinkery-pink',
			'color' => '#d42589',
		],
		[
			'name'  => __( 'Thinkery Yellow', 'genesis-sample' ),
			'slug'  => 'thinkery-yellow',
			'color' => '#ffb600',
		],
		[
			'name'  => __( 'Thinkery Dark Grey', 'genesis-sample' ),
			'slug'  => 'thinkery-dark-grey',
			'color' => '#1b2432',
		],
		[
			'name'  => __( 'Thinkery Medium Grey', 'genesis-sample' ),
			'slug'  => 'thinkery-medium-grey',
			'color' => '#c4c5d4',
		],
		[
			'name'  => __( 'Thinkery Light Grey', 'genesis-sample' ),
			'slug'  => 'thinkery-light-grey',
			'color' => '#e7ecf3',
		],
		[
			'name'  => __( 'White', 'genesis-sample' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'X-Small', 'genesis-sample' ),
			'size' => 14,
			'slug' => 'x-small',
		],
		[
			'name' => __( 'Small', 'genesis-sample' ),
			'size' => 16,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'genesis-sample' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Medium', 'genesis-sample' ),
			'size' => 20,
			'slug' => 'medium',
		],
		[
			'name' => __( 'Large', 'genesis-sample' ),
			'size' => 28,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'genesis-sample' ),
			'size' => 40,
			'slug' => 'larger',
		],
		[
			'name' => __( 'Largest', 'genesis-sample' ),
			'size' => 48,
			'slug' => 'largest',
		],
	],
];