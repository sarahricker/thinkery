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

		// Get chosen Block Areas from Customizer
		$block_area_blog = get_theme_mod( 'blog_header_block_area' );
		$block_area_search = get_theme_mod( 'search_page_block_area' );


		if ( $block_area_blog || $block_area_search ) {
			add_action( 'genesis_after_header', [ $self, 'load_block_area' ] );
		}
	}

	/**
	 * Load Block Area
	 */
	public function load_block_area() {

		if ( is_singular() || is_404() || is_archive( 'tribe_events' ) ) {
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

		// Load our custom block area if set
		$this->page_header_block_area();
	}

	/**
	 * Output the chosen block area.
	 */
	public function page_header_block_area() {
		if ( ! class_exists( '\Thinkery\Block_Area' ) ) {
			return;
		}
		if ( is_search() ) {
			$block_area = get_theme_mod( 'search_page_block_area', true );
		} else {
			$block_area = get_theme_mod( 'blog_header_block_area', true );
		}

		echo '<div class="archive-hero">';
		\Thinkery\block_area()->show( $block_area );
		echo '</div>';
	}
}