<?php
/**
 * Block Area widget.
 *
 * @package wpengine-blocks
 */

namespace Thinkery;

/**
 * Class to handle block area widget.
 */
class Block_Widget extends \WP_Widget {

	/**
	 * Add block area widget.
	 */
	public function __construct() {
		$widget_options = [
			'classname'   => 'block_area_widget',
			'description' => 'Add a Block Area as a widget.',
		];
		$this->defaults = array(
			'block-area' => '',
		);
		parent::__construct( 'block_area_widget', 'Block Area Widget', $widget_options );
	}

	/** Display Block area widget.
	 *
	 * @param var $args Args.
	 * @param var $instance Instance.
	 */
	public function widget( $args, $instance ) {
		$block_area = ! empty( $instance['block-area'] ) ? $instance['block-area'] : '';
		\Thinkery\block_area()->show( $block_area );
	}

	/** Block area widget form.
	 *
	 * @param var $instance Instance.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<label for="<?php echo esc_html( $this->get_field_name( 'block-area' ) ); ?>">Choose a Block Area</label>
		<select id="<?php echo esc_html( $this->get_field_id( 'block-area' ) ); ?>" name="<?php echo esc_html( $this->get_field_name( 'block-area' ) ); ?>">
			<?php
			$args = [
				'numberposts' => '-1',
				'post_type'   => 'block_area',
			];

			// Get a list of block areas and create a dropdown.
			$block_areas = get_posts( $args );

			foreach ( $block_areas as $block_area ) {
				$block_id    = $block_area->ID;
				$block_title = $block_area->post_title;
				?>
				<option value="<?php echo esc_html( $block_id ); ?>"<?php selected( $instance['block-area'], $block_id ); ?>><?php echo esc_html( $block_title ); ?></option>
				<?php
			}
			?>
		</select>
		<?php
	}
}