<?php
/**
 * This file adds the archive template to the Thinkery Theme.
 *
 * @package Thinkery
 */

// Get chosen Block Area from Customizer > Blog Page Header Block Area
$block_area = get_theme_mod( 'blog_header_block_area' );

// Remove entry titles if using a block area
if ( ! empty( $block_area ) ) {;

	// Remove Title and Description on Blog Archive
	remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

	// Remove Title and Description on Date Archive
	remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );

	// Remove Title and Description on Archive, Taxonomy, Category, Tag
	remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

	// Remove Title and Description on Author Archive
	remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );

	// Remove Title and Description on Blog Template Page
	remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );

	// Load our custom block area if set, otherwise fallback to default entry header
	add_action( 'genesis_before_loop', 'thinkery_blog_header_block_area' );

	// Add body class if custom block area is set
	add_filter( 'body_class', 'thinkery_blog_header_body_class' );

} else {

	do_action( 'genesis_entry_header' );
}

/**
 * Add custom body class to the head
 */
function thinkery_blog_header_body_class( $classes ) {
	$classes[] = 'genesis-title-hidden';
	return $classes;
}

/**
 * Output the chosen block area.
 */
function thinkery_blog_header_block_area() {
	if ( ! class_exists( '\Thinkery\Block_Area' ) ) {
		return;
	}

	$block_area = get_theme_mod( 'blog_header_block_area', true );
	\Thinkery\block_area()->show( $block_area );
}

genesis();