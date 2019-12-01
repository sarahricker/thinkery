<?php
/**
 * Handles custom shortcodes
 *
 * @package Genesis Sample
 */

namespace Thinkery;

/**
 * Build the shortcode class
 */
class Archive_Header {

	/**
	 * Initialize the class.
	 */
	public static function init() {
		$self = new self();

		// Get chosen Block Area from Customizer > Blog Page Header Block Area
		$block_area = get_theme_mod( 'blog_header_block_area' );

		if ( ! empty( $block_area ) ) {
			add_action( 'genesis_after_header', [ $self, 'load_block_area' ] );
		}
	}

	/**
	 * Load Block Area
	 */
	public function load_block_area() {

		if ( is_singular() ) {
			return;
		}

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
		$this->blog_header_block_area();
	}

	/**
	 * Output the chosen block area.
	 */
	public function blog_header_block_area() {
		if ( ! class_exists( '\Thinkery\Block_Area' ) ) {
			return;
		}
		$block_area = get_theme_mod( 'blog_header_block_area', true );
		echo '<div class="archive-hero">';
		\Thinkery\block_area()->show( $block_area );
		echo '</div>';
	}
}