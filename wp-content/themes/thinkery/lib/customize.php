<?php
/**
 * Genesis Sample.
 *
 * This file adds the Customizer additions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

add_action( 'customize_register', 'genesis_sample_customizer_register' );
/**
 * Registers settings and controls with the Customizer.
 *
 * @since 2.2.3
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_sample_customizer_register( $wp_customize ) {

	$appearance = genesis_get_config( 'appearance' );

	$wp_customize->add_setting(
		'genesis_sample_link_color',
		[
			'default'           => $appearance['default-colors']['link'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_link_color',
			[
				'description' => __( 'Change the color of post info links and button blocks, the hover color of linked titles and menu items, and more.', 'genesis-sample' ),
				'label'       => __( 'Link Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_link_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_primary_color',
		[
			'default'           => $appearance['default-colors']['primary'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_primary_color',
			[
				'description' => __( 'Change the default primary color for text.', 'genesis-sample' ),
				'label'       => __( 'Primary Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_primary_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_accent_color',
		[
			'default'           => $appearance['default-colors']['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'genesis_sample_accent_color',
			[
				'description' => __( 'Change the default hover color for button links, menu buttons, and submit buttons. The button block uses the Link Color.', 'genesis-sample' ),
				'label'       => __( 'Accent Color', 'genesis-sample' ),
				'section'     => 'colors',
				'settings'    => 'genesis_sample_accent_color',
			]
		)
	);

	$wp_customize->add_setting(
		'genesis_sample_logo_width',
		[
			'default'           => 350,
			'sanitize_callback' => 'absint',
			'validate_callback' => 'genesis_sample_validate_logo_width',
		]
	);

	// Add a control for the logo size.
	$wp_customize->add_control(
		'genesis_sample_logo_width',
		[
			'label'       => __( 'Logo Width', 'genesis-sample' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'genesis-sample' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'genesis_sample_logo_width',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 100,
			],

		]
	);

	/**
	 * Add options to customize the Blog Page Header (Block area selector)
	 *
	 */
	$wp_customize->add_setting(
		'blog_header_block_area' , array(
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_section( 'blog-page',
		array(
			'title' => esc_html_x( 'Blog Page Header', 'customizer section title', 'wpengine-magazine' ),
		)
	);
	// Get Block Area Posts to populate select option
	$args = [
		'numberposts' => '-1',
		'post_type' => 'block_area',
	];
	$block_area_list = get_posts( $args );
	$block_areas[0] = 'Select Block Area';

	foreach( $block_area_list as $block_area ) {
		$key = $block_area->post_name;
		$block_areas[$block_area->ID] = $key;
	}
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'blog_header_block_area', array(
				'section'       => 'blog-page',
				'label'         => esc_html__( 'Blog Page Header Block Area', 'wpengine-magazine' ),
				'description'   => esc_html__( 'Select the block area to show on the blog archive pages.', 'wpengine-magazine' ),
				'type'           => 'select',
				'choices'        => $block_areas,
			)
		)
	);

	/**
	 * Add options to customize the 404 Page (Block area selector)
	 *
	 */
	$wp_customize->add_setting(
		'404_page_block_area' , array(
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_section( '404-page',
		array(
			'title' => esc_html_x( '404 Page', 'customizer section title', 'thinkery' ),
		)
	);
	// Get Block Area Posts to populate select option
	$args = [
		'numberposts' => '-1',
		'post_type' => 'block_area',
	];
	$block_area_list = get_posts( $args );
	$block_areas[0] = 'Select Block Area';

	foreach( $block_area_list as $block_area ) {
		$key = $block_area->post_name;
		$block_areas[$block_area->ID] = $key;
	}
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, '404_page_block_area', array(
				'section'       => '404-page',
				'label'         => esc_html__( '404 Page Block Area', 'thinkery' ),
				'description'   => esc_html__( 'Select the block area to show on the 404 page.', 'thinkery' ),
				'type'           => 'select',
				'choices'        => $block_areas,
			)
		)
	);


	/**
	 * Add options to customize the Search Results Page (Block area selector)
	 *
	 */
	$wp_customize->add_setting(
		'search_page_block_area' , array(
			'transport' => 'refresh',
		)
	);
	$wp_customize->add_section( 'search-page',
		array(
			'title' => esc_html_x( 'Search Results Page', 'customizer section title', 'thinkery' ),
		)
	);
	// Get Block Area Posts to populate select option
	$args = [
		'numberposts' => '-1',
		'post_type' => 'block_area',
	];
	$block_area_list = get_posts( $args );
	$block_areas[0] = 'Select Block Area';

	foreach( $block_area_list as $block_area ) {
		$key = $block_area->post_name;
		$block_areas[$block_area->ID] = $key;
	}
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 'search_page_block_area', array(
				'section'       => 'search-page',
				'label'         => esc_html__( 'Search Results Page Block Area', 'thinkery' ),
				'description'   => esc_html__( 'Select the block area to show on the Search Results page.', 'thinkery' ),
				'type'           => 'select',
				'choices'        => $block_areas,
			)
		)
	);

}

/**
 * Displays a message if the entered width is not numeric or greater than 100.
 *
 * @param object $validity The validity status.
 * @param int    $width The width entered by the user.
 * @return int The new width.
 */
function genesis_sample_validate_logo_width( $validity, $width ) {

	if ( empty( $width ) || ! is_numeric( $width ) ) {
		$validity->add( 'required', __( 'You must supply a valid number.', 'genesis-sample' ) );
	} elseif ( $width < 100 ) {
		$validity->add( 'logo_too_small', __( 'The logo width cannot be less than 100.', 'genesis-sample' ) );
	}

	return $validity;

}