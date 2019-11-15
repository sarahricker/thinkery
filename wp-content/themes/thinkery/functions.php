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

// Load our shortcodes.
Shortcodes::init();

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


// Adds header info bar.
add_action( 'genesis_before_header', 'thinkery_info_bar', 12 );
/**
 * Sets up info bar at top of page before header navigation.
 *
 */
function thinkery_info_bar() {

	echo '<div class="header-info-bar">';
		echo '<div class="wrap">';
			echo '<div class="left">';
				echo '<div class="open-hours"><i class="far fa-clock"></i> Today <span class="hours">' . do_shortcode( '[thinkery_current_hours]' ) . '<span></div>';
			echo '</div>';
			echo '<div class="right">';
				echo '<div class="phone"><a href="tel:123-123-1234"><i class="fas fa-phone-alt"></i>' . do_shortcode( '[thinkery_phone]' ) . '</div></a>';
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
