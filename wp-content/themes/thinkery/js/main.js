jQuery(function ($) {

	/**
	 * Slideout Mobiile Navigation
	 */

	var slideout = new Slideout({
		'panel': document.getElementById('site-container'),
		'menu': document.getElementById('slideout-menu'),
		padding: 1100,
		tolerance: 70,
	});

	// Toggle Slideout Nav (to open)
	document.querySelector( '.menu-toggle' ).addEventListener(
		'click', function() {
			slideout.toggle();
		}
	);

	// Toggle Slideout Nav (to close)
	document.querySelector( '.close-icon' ).addEventListener(
		'click', function() {
			slideout.toggle();
		}
	);


	/**
	 * Handle the slideout menu when resizing the window.
	 *
	 * If the slideout is open and the new window size is less than 768,
	 * run the `open` function to recalculate the slideout menu size.
	 *
	 * If the slideout is open and the new window size is 768 or greater,
	 * close the slideout menu since we no longer have a mobile menu option.
	 */

	$( window ).resize(function() {
		if ( slideout.isOpen() ) {
			if ( 960 <= window.innerWidth ) {
				slideout.close();
			} else {
				slideout.open();
			}
		}
	});
});