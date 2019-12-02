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
class Blog_Toolbar {

	/**
	 * Initialize the class.
	 */
	public static function init() {
		$self = new self();

		add_action( 'genesis_after_header', [ $self, 'load_blog_toolbar' ] );
	}

	/**
	 * Load Block Area
	 */
	public function load_blog_toolbar() {
		if ( !is_front_page() && is_home() || is_archive() ) {
			// Load our blog toolbar before the loop
			$this->blog_toolbar_area();
		}
	}

	/**
	 * Output the chosen block area.
	 */
	public function blog_toolbar_area() { ?>
		<div class="blog-toolbar-container alignfull">
			<div class="blog-toolbar-container-inside">
				<div class="category-selector">
					<i class="fa fa-chevron-down"></i>
					<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">

						<?php
						$args = array(
							'show_option_none' => __( 'Select Category', 'thinkery' ),
							'show_count'       => 0,
							'orderby'          => 'name',
							'echo'             => 0,
							'selected'         => 0,
						);
						?>

						<?php $select  = wp_dropdown_categories( $args ); ?>
						<?php $replace = "<select$1 onchange='return this.form.submit()'>"; ?>
						<?php $select  = preg_replace( '#<select([^>]*)>#', $replace, $select ); ?>

						<?php echo $select; ?>
						<noscript>
							<input type="submit" value="View" />
						</noscript>

					</form>
				</div>
				<?php get_search_form();?>
			</div>
		</div>
		<?php
	}
}