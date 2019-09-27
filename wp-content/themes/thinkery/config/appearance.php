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
	'accent' => '#0073e5',
];

$genesis_sample_link_color = get_theme_mod(
	'genesis_sample_link_color',
	$genesis_sample_default_colors['link']
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
	'button-bg'            => $genesis_sample_link_color,
	'button-color'         => $genesis_sample_link_color_contrast,
	'button-outline-hover' => $genesis_sample_link_color_brightness,
	'link-color'           => $genesis_sample_link_color,
	'default-colors'       => $genesis_sample_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'genesis-sample' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $genesis_sample_link_color,
		],
		[
			'name'  => __( 'Accent color', 'genesis-sample' ),
			'slug'  => 'theme-secondary',
			'color' => $genesis_sample_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'genesis-sample' ),
			'size' => 14,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'genesis-sample' ),
			'size' => 16,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'genesis-sample' ),
			'size' => 18,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'genesis-sample' ),
			'size' => 21,
			'slug' => 'larger',
		],
	],
];
