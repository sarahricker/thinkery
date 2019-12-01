<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

// Include custom classes
require_once get_stylesheet_directory() . '/classes/class-shortcodes.php';
require_once get_stylesheet_directory() . '/classes/class-thinkery-search-form.php';
require_once get_stylesheet_directory() . '/classes/class-block-area.php';
require_once get_stylesheet_directory() . '/classes/class-block-area-widget.php';
require_once get_stylesheet_directory() . '/classes/class-archive-hero-block-area.php';

// Load our shortcodes.
Thinkery\Shortcodes::init();

// Load BLock Area Hero
Thinkery\Archive_Header::init();


add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style(
		genesis_get_theme_handle() . '-fonts',
		$appearance['fonts-url'],
		[],
		genesis_get_theme_version()
	);

	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/amp/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}

	wp_enqueue_script(
		'magazine-entry-date',
		get_stylesheet_directory_uri() . '/js/vendor/slideout-1.0.1/dist/slideout.min.js',
		array( 'jquery' ),
		'1.0.0'
	);

	wp_enqueue_script(
		'thinkery-main',
		get_stylesheet_directory_uri() . '/js/main.js',
		array( 'jquery' ),
		'',
		true
	);

	wp_enqueue_script(
		'thinkery-fontawesome-kit',
		'https://kit.fontawesome.com/193f8033dd.js',
		array(),
		'',
		true
	);
}

add_action( 'after_setup_theme', 'genesis_sample_theme_support', 9 );

function thinkery_gutenberg_enqueue() {
	wp_enqueue_script(
		'thinkery-gutenberg-script',
		get_stylesheet_directory_uri() . '/js/gutenberg.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ),
		'1.0.0'
	);
}
add_action( 'enqueue_block_editor_assets', 'thinkery_gutenberg_enqueue' );

/**
 * Add desired theme supports.
 *
 * See config file at `config/theme-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_theme_support() {

	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		 add_theme_support( $feature, $args );
	}

}

add_action( 'after_setup_theme', 'genesis_sample_post_type_support', 9 );
/**
 * Add desired post type supports.
 *
 * See config file at `config/post-type-supports.php`.
 *
 * @since 3.0.0
 */
function genesis_sample_post_type_support() {

	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );
add_image_size( 'genesis-singular-images', 702, 526, true );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

/**
 * Force posts layout
 */
function thinkery_posts_layout() {
	if ( is_singular( array( 'post' ) ) ) {
		return 'content-sidebar';
	}
}
add_filter( 'genesis_site_layout', 'thinkery_posts_layout' );


/**
 * Archive Post Class
 *
 * Breaks the posts into three columns
 *
 * @param array $classes
 * @return array
 */
function thinkery_archive_post_class( $classes ) {

	if( is_singular() ) {
		return $classes;
	}

	global $wp_query;
	if( ! $wp_query->is_main_query() ) {
		return $classes;
	}

	$classes[] = 'one-third';
	if( 0 == $wp_query->current_post % 3 ) {
		$classes[] = 'first';
	}
	return $classes;
}
add_filter( 'post_class', 'thinkery_archive_post_class' );

// Removes the default post image.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );


//* Customize the entry meta in the entry header (requires HTML5 theme support)
function thinkery_post_info_filter( $post_info ) {
	if ( !is_singular() ) {
		$post_info = '[post_date]';
	}
	return $post_info;
}
remove_action( 'genesis_entry_header', 'genesis_post_info', 12);
add_action( 'genesis_entry_header', 'genesis_post_info', 9 );
add_filter( 'genesis_post_info', 'thinkery_post_info_filter' );

// Remove entry content on blog and archives.
function thinkery_remove_entry_content_archives() {
	if (is_home() || is_archive() || is_search() ) {
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
	}
}
add_action ( 'genesis_before_entry' , 'thinkery_remove_entry_content_archives' );


/**
 * Add custom body class to the head
 */
function thinkery_programs_body_class( $classes ) {
	$classes[] = 'genesis-title-hidden';
	return $classes;
}

/**
 * Hide Title + entry content on custom post types
 */
function thinkery_cpt_title_hide() {
	if ( is_singular( array( 'program', 'exhibit' ) ) ) {
		add_filter( 'body_class', 'thinkery_programs_body_class' );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	}
}
add_action( 'wp', 'thinkery_cpt_title_hide' );


/**
 * Register new widgets
 */
function thinkery_widgets_init() {
	// Open Hours Widget area (Info Bar)
	register_sidebar( array(
		'name'          => __( 'Open Hours', 'thinkery' ),
		'id'            => 'open-hours',
		'description'   => __( 'Widget appears in left side of top info bar.', 'textdomain' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => '</li>',
	) );
}
add_action( 'widgets_init', 'thinkery_widgets_init' );

/**
 * Add our Block Area Widget
 */
function thinkery_add_block_area_widget() {
	register_widget( 'Thinkery\Block_Widget' );
}
add_action( 'widgets_init', 'thinkery_add_block_area_widget');

/**
 * Add our Reusable Blocks to Admin Menu
 */
function thinkery_add_reusable_blocks_ui() {
	add_menu_page( __( 'Reusable Blocks', 'reusable-blocks-ui' ), __( 'Reusable Blocks', 'reusable-blocks-ui' ), 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
}
add_action( 'admin_menu', 'thinkery_add_reusable_blocks_ui' );



// Adds header info bar.
add_action( 'genesis_before_header', 'thinkery_info_bar', 12 );
/**
 * Sets up info bar at top of page before header navigation.
 *
 */
function thinkery_info_bar() {

	echo '<div class="header-info-bar">';
		echo '<div class="wrap">';
			if ( is_active_sidebar( 'open-hours' ) ) {
				echo '<div class="left">';
					echo '<div class="open-hours"><i class="far fa-clock"></i><span class="hours"> ';
					dynamic_sidebar('open-hours');
					echo '</span></div>';
				echo '</div>';
			}
			echo '<div class="right">';
				echo '<div class="phone"><i class="fas fa-phone-alt"></i>' . do_shortcode( '[thinkery_phone]' ) . '</div>';
				echo '<div id="google_translate_element" aria-label="google translate languages" class="translate"><i class="fas fa-globe-americas"></i></div>';
				?>
				<script type="text/javascript">// init google translate
					function googleTranslateElementInit() {

						// load google translate widget into #google_translate_element
						new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');

						// Prevent duplicate "original text" h1 in Google tranlate widget
						var removePopup = document.getElementById('goog-gt-tt');
						removePopup.parentNode.removeChild(removePopup);

					}

					// adjust element for accessibility compliance
					var old_googleTranslateElementInit = googleTranslateElementInit;
					googleTranslateElementInit = function() {
						old_googleTranslateElementInit();
						jQuery('#google_translate_element .goog-te-combo').attr('aria-label', 'translate page language');
					}
				</script>
				<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				<?php
			echo '</div>';
		echo '</div>';
	echo '</div>';
}


// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

/**
 * Add search form to site header
 */
add_action( 'genesis_header', 'thinkery_search', 13 );

/**
 * Render search form.
 */
function thinkery_search() {
	if ( is_page_template( 'page-templates/landing.php' ) ) {
		return false;
	}
	get_search_form();
}
/**
 * Customize search form input box text
 */
add_filter( 'genesis_search_text', 'thinkery_search_input_text' );
/**
 * Render search input text.
 *
 * @param string $text   Search input text.
 * @return string        Search input text.
 */
function thinkery_search_input_text( $text ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
	return esc_attr( 'search' );
}

/**
 * Modify the site-container div attributes to support slideout nav.
 */
add_filter( 'genesis_attr_site-container', 'thinkery_container_attributes' );
/**
 * Modify the site-container div attributes to support slidout nav.
 *
 * @param array $attr The original attributes.
 * @return array The modified attributes.
 */
function thinkery_container_attributes( $attr ) {
	$attr['id'] = 'slideout-panel';
	$attr['id'] = 'site-container';
	return $attr;
}

/**
 * Setup custom mobile slideout menu.
 */
add_action( 'genesis_before', 'thinkery_custom_side_menu' );
/**
 * Adds `#sideout-menu` above `.site-container`.
 */
function thinkery_custom_side_menu() { ?>
	<div id="slideout-menu" class="side-menu">
		<div class="wrap">
			<div class="side-menu-header">
				<div class="logo">
					<a href="/sites/"><img src="<?php echo esc_url( CHILD_URL . '/images/logo-thinkery-bug.png' ); ?>" alt="Thinkery" /></a>
				</div>
				<button class="close-icon">
					<i class="fas fa-times"></i> Close
				</button>
			</div>
			<?php
				// Add Primary Nav to side-menu
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'fallback_cb'    => false, // Do not fall back to wp_page_menu()
					)
				);
				// Add search form to side-menu
				get_search_form();
			?>
		</div>
	</div>
	<?php
}


add_filter( 'wp_nav_menu_args', 'thinkery_limit_mobile_menu_depth' );
/**
 * Reduce the primary navigation menu to one level depth
 */
function thinkery_limit_mobile_menu_depth( $args ){

	$args['depth'] = 2;

	if( 'mobile' == $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;
}

/**
 * Add custom menu toggle.
 */
add_action( 'genesis_header_right', 'thinkery_custom_mobile_toggle' );
/**
 * Add custom menu toggle.
 */
function thinkery_custom_mobile_toggle() {
	echo '<button class="menu-toggle" id="genesis-mobile-nav-primary">Menu <i class="fas fa-bars"></i></button>';
}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}

// Adds custom color support for Events Calendar Categories
if ( class_exists( '\\Fragen\\Category_Colors\\Main' ) ) {
	teccc_add_legend_view( 'day' );
}


/*
 * Alters event's archive titles
 * Modified version of: https://support.theeventscalendar.com/435435-Altering-or-removing-titles-on-calendar-views
 */
function tribe_alter_event_archive_titles ( $original_recipe_title, $depth ) {

	// Generate custom todays date prefix
	$todays_date = date('l, F j, Y');
	$view_date = date_i18n(
		tribe_get_date_option( 'date_with_year', 'l, F j, Y' ),
		strtotime( tribe_get_month_view_date() )
	);
	if ( $view_date == $todays_date) {
		$title_prefix = 'Today\'s Events';
	} else {
		$title_prefix = 'Events for';
	}

	// Modify the titles here
	// Some of these include %1$s and %2$s, these will be replaced with relevant dates
	$title_upcoming =   'Upcoming Events'; // List View: Upcoming events
	$title_past =       'Past Events'; // List view: Past events
	$title_range =      'Events for <span class="date">%1$s - %2$s</span>'; // List view: range of dates being viewed
	$title_month =      'Events for <span class="date">%1$s</span>'; // Month View, %1$s = the name of the month
	$title_day =        $title_prefix . '<span class="date">%1$s</span>'; // Day View, %1$s = the day
	$title_all =        'All events <span class="date">for %s</span>'; // showing all recurrences of an event, %s = event title
	$title_week =       'Events for week of <span class="date">%s</span>'; // Week view
	// Don't modify anything below this unless you know what it does
	global $wp_query;
	$tribe_ecp = Tribe__Events__Main::instance();
	$date_format = apply_filters( 'tribe_events_pro_page_title_date_format', tribe_get_date_format( true ) );
	// Default Title
	$title = $title_upcoming;
	// If there's a date selected in the tribe bar, show the date range of the currently showing events
	if ( isset( $_REQUEST['tribe-bar-date'] ) && $wp_query->have_posts() ) {
		if ( $wp_query->get( 'paged' ) > 1 ) {
			// if we're on page 1, show the selected tribe-bar-date as the first date in the range
			$first_event_date = tribe_get_start_date( $wp_query->posts[0], false );
		} else {
			//otherwise show the start date of the first event in the results
			$first_event_date = tribe_event_format_date( $_REQUEST['tribe-bar-date'], false );
		}
		$last_event_date = tribe_get_end_date( $wp_query->posts[ count( $wp_query->posts ) - 1 ], false );
		$title = sprintf( $title_range, $first_event_date, $last_event_date );
	} elseif ( tribe_is_past() ) {
		$title = $title_past;
	}
	// Month view title
	if ( tribe_is_month() ) {
		$title = sprintf(
			$title_month,
			date_i18n( tribe_get_option( 'monthAndYearFormat', 'F Y' ), strtotime( tribe_get_month_view_date() ) )
		);
	}
	// Day view title
	if ( tribe_is_day() ) {

		$title = sprintf(
			$title_day,
			date_i18n( tribe_get_date_format( true ), strtotime( $wp_query->get( 'start_date' ) ) )
		);
	}
	// All recurrences of an event
	if ( function_exists('tribe_is_showing_all') && tribe_is_showing_all() ) {
		$title = sprintf( $title_all, get_the_title() );
	}
	// Week view title
	if ( function_exists('tribe_is_week') && tribe_is_week() ) {
		$title = sprintf(
			$title_week,
			date_i18n( $date_format, strtotime( tribe_get_first_week_day( $wp_query->get( 'start_date' ) ) ) )
		);
	}
	if ( is_tax( $tribe_ecp->get_event_taxonomy() ) && $depth ) {
		$cat = get_queried_object();
		$title = '<a href="' . esc_url( tribe_get_events_link() ) . '">' . $title . '</a>';
		$title .= ' &#8250; ' . $cat->name;
	}
	return $title;
}
add_filter( 'tribe_get_events_title', 'tribe_alter_event_archive_titles', 11, 2 );
