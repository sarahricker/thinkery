jQuery(function ($) {
	/**
	 * Hide Modern tribe mini calendar event list until clicked
	 */
	$( ".tribe-mini-calendar-list-wrapper" ).hide();
	$( ".tribe-mini-calendar-grid-wrapper" ).on( "click", function() {
		$( ".tribe-mini-calendar-list-wrapper" ).fadeIn();
	} );

	$( document ).ready(function(){
		// Change default related events image
		$( '.tribe-related-events-thumbnail img' ).each( function ( index, value ) {
			if ( ! $( this ).hasClass('wp-post-image') ) {
				$( this ).attr('src', document.location.origin + '/wp-content/themes/thinkery/images/default-thinkery.jpg');
			};
		} );
	} );

	// Wrap related events to style full width
	$( ".tribe-block__related-events__title, .tribe-related-events" ).wrapAll( "<div class='alignfull full-width-related-events'></div>" ).wrapAll( "<div class='inner'></div>" );

	/**
	 * Slideout Search Bar in Header
	 */
	$( ".search-form-submit" ).on( 'click focus', function ( e ) {
		$( this ).parent().addClass( 'active' ).find( 'input[type="search"]' ).focus();

		if( $(this).parent().find( 'input[type="search"]' ).val() == '' ) {
			e.preventDefault();
		}
	} );

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