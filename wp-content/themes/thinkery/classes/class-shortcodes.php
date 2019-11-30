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
class Shortcodes {

	/**
	 * Initialize the class.
	 */
	public static function init() {
		$self = new self();
		add_action( 'wp', [ $self, 'shortcodes' ] );
	}

	/**
	 * Register our shortcodes.
	 */
	public function shortcodes() {
		add_shortcode( 'thinkery_phone', [ $this, 'do_shortcode_phone' ] );
		add_shortcode( 'thinkery_address', [ $this, 'do_shortcode_address' ] );
		add_shortcode( 'thinkery_post_title', [ $this, 'do_shortcode_post_title' ] );
	}

	/**
	 * Shortcode to show the phone number set in Customizer.
	 *
	 * @param  array $atts  Array of shortcode attributes.
	 * @return string       The phone number in a tel: link
	 */
	public function do_shortcode_phone( $atts ) {
		$atts = shortcode_atts(
			[
				'pre'    => '',
				'number' => '512-469-6200',
				'post'   => '',
			],
			$atts,
			'thinkery_phone'
		);

		$number = $atts['number'];

		$pre  = ! empty( $atts['pre'] ) ? $atts['pre'] . ' ' : null;
		$post = ! empty( $atts['post'] ) ? ' ' . $atts['post'] : null;

		return sprintf(
			'<a href="tel:%1$s">%2$s%1$s%3$s</a>',
			esc_attr( $number ),
			esc_html( $pre ),
			esc_html( $post )
		);
	}

	/**
	 * Shortcode to show the address set in the Customizer
	 *
	 * @param  array $atts  Array of shortcode attributes.
	 * @return string       The address of the relevant office.
	 */
	public function do_shortcode_address( $atts ) {
		$atts = shortcode_atts(
			[
				'address' => '1830 Simond Ave<br>Austin, Texas 78723',
			],
			$atts,
			'thinkery_address'
		);

		return $atts['address'];
	}

	/**
	 * Shortcode to show the post title (use in blocks to create dynamic header)
	 *
	 * @return string       The post title of the curent post/page.
	 */

	public function do_shortcode_post_title( $atts ) {
		$atts = shortcode_atts(
			array(
				'id' => get_queried_object_id(),
			),
			$atts,
			'thinkery_title'
		);

		if ( is_category() || is_tag() || is_tax() || is_post_type_archive() ) {

			return get_the_archive_title( absint( $atts['id'] ) );

		} elseif ( is_author() ) {

			return get_the_author_meta( 'user_nicename', absint( $atts['id'] ) );

		} else {

			return get_the_title( absint( $atts['id'] ) );
		}
	}
}