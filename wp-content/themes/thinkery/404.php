<?php
 /**
 * 404 Page
 *
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

/**
 * Remove default loop.
 */
remove_action( 'genesis_loop', 'genesis_do_loop' );

/**
 * Get Full Page Width layout (no sidebar)
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/**
 * Remove custom hero header
 */
remove_action( 'genesis_before_content_sidebar_wrap', 'thinkery_hero_header', 1 );

/**
 * Output a 404 "Not Found" heading.
 */
add_action( 'genesis_loop', 'genesis_404_heading' );
/**
 * Output a 404 "Not Found" heading.
 *
 * Based on original Genesis 404.php.
 * @since 1.6
 */
function genesis_404_heading() {

	genesis_markup(
		[
			'open'    => '<article class="entry">',
			'context' => 'entry-404',
		]
	);

	genesis_markup(
		[
			'open'    => '<h1 %s>',
			'close'   => '</h1>',
			'content' => apply_filters( 'genesis_404_entry_title', __( 'We couldn\'t find your page', 'thinkery' ) ),
			'context' => 'entry-title',
		]
	);

	genesis_markup(
		[
			'close'   => '</article>',
			'context' => 'entry-404',
		]
	);

}

// Get chosen 404 Block Area from Customizer > 404 Page
$block_area = get_theme_mod( '404_page_block_area' );

// Load our custom block area if set, otherwise print out fallback 404 content
if ( ! empty( $block_area ) ) {
	add_action( 'genesis_after_content', 'thinkery_404_block_area' );
} else {
	add_action( 'genesis_loop', 'genesis_404_content' );
}

/**
 * Output fallback 404 content.
 */
function genesis_404_content() {

	$genesis_404_content = sprintf(
		/* translators: %s: URL for current website. */

		__( 'The page you were looking for does not exist or is no longer available. You can either return to the <a href="%s">homepage</a> or use the search box in the upper right corner of any page to find the content you were looking for.', 'thinkery' ),
		esc_url( trailingslashit( home_url() ) )
	);

	$genesis_404_content = sprintf( '<p>%s</p>', $genesis_404_content );

	/**
	 * The 404 content (wrapped in paragraph tags).
	 *
	 * @since 2.2.0
	 *
	 * @param string $genesis_404_content The content.
	 */
	$genesis_404_content = apply_filters( 'genesis_404_entry_content', $genesis_404_content );

	genesis_markup(
		[
			'open'    => '<div %s>',
			'close'   => '</div>',
			'content' => $genesis_404_content,
			'context' => 'entry-content',
		]
	);
}

/**
 * Output the chosen block area.
 */
function thinkery_404_block_area() {
	if ( ! class_exists( '\Thinkery\Block_Area' ) ) {
		return;
	}

	$block_area = get_theme_mod( '404_page_block_area', true );
	\Thinkery\block_area()->show( $block_area );
}

genesis();