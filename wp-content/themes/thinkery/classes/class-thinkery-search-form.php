<?php
/**
 * Custom search form for the theme.
 *
 * @package Genesis Sample
 */
/**
 * Custom Thinkery Search Form extends Genesis_Search_Form
 */
class Thinkery_Search_Form extends Genesis_Search_Form {
	/**
	 * Get submit button markup.
	 *
	 * @since 2.7.0
	 *
	 * @return string Submit button markup.
	 */
	protected function get_submit() {
		return $this->markup(
			[
				'open'    => '<button %s>',
				'close'   => '</button>',
				'content' => '<i class="fa fa-search"></i>',
				'context' => 'search-form-submit',
				'params'  => [
					'aria-label' => $this->strings['submit_value'],
				],
			]
		);
	}
}