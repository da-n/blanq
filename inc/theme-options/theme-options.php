<?php
/**
 * blanq Theme Options
 *
 * @package blanq
 * @since blanq 1.0
 */

/**
 * Register the form setting for our blanq_options array.
 *
 * This function is attached to the admin_init action hook.
 *
 * This call to register_setting() registers a validation callback, blanq_theme_options_validate(),
 * which is used when the option is saved, to ensure that our option values are properly
 * formatted, and safe.
 *
 * @since blanq 1.0
 */
function blanq_theme_options_init() {
	register_setting(
		'blanq_options', // Options group, see settings_fields() call in blanq_theme_options_render_page()
		'blanq_theme_options', // Database option, see blanq_get_theme_options()
		'blanq_theme_options_validate' // The sanitization callback, see blanq_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see blanq_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field( 'custom_logo', __( 'Custom Logo', 'blanq' ), 'blanq_settings_field_custom_logo', 'theme_options', 'general' );
}
add_action( 'admin_init', 'blanq_theme_options_init' );

/**
 * Change the capability required to save the 'blanq_options' options group.
 *
 * @see blanq_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see blanq_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function blanq_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_blanq_options', 'blanq_option_page_capability' );

/**
 * Add our theme options page to the admin menu.
 *
 * This function is attached to the admin_menu action hook.
 *
 * @since blanq 1.0
 */
function blanq_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'blanq' ),   // Name of page
		__( 'Theme Options', 'blanq' ),   // Label in menu
		'edit_theme_options',          // Capability required
		'theme_options',               // Menu slug, used to uniquely identify the page
		'blanq_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'blanq_theme_options_add_page' );

/**
 * Renders the Theme Options administration screen.
 *
 * @since blanq 1.0
 */
function blanq_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>
		<h2><?php printf( __( '%s Theme Options', 'blanq' ), $theme_name ); ?></h2>
		<p>There are no options for this theme.</p>
	</div>
	<?php
}