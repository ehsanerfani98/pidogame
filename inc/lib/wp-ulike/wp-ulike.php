<?php


// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Do not change these values
define( 'WP_ULIKE_PLUGIN_URI'   , 'https://plussweb.ir/' 		 	);
define( 'WP_ULIKE_VERSION'      , '4.6.3' 					 		);
define( 'WP_ULIKE_DB_VERSION'   , '2.3' 					 	 	);
define( 'WP_ULIKE_SLUG'         , 'wp-ulike' 					 	);
define( 'WP_ULIKE_NAME'         , __( 'WP ULike', WP_ULIKE_SLUG )	);

define( 'WP_ULIKE_DIR'          , plugin_dir_path( __FILE__ ) 	 	);
define( 'WP_ULIKE_URL'          , plugins_url( '', __FILE__ ) 	 	);
define( 'WP_ULIKE_BASENAME'     , plugin_basename( __FILE__ ) 	 	);

define( 'WP_ULIKE_ADMIN_DIR'    , WP_ULIKE_DIR . 'admin' 		 	);
define( 'WP_ULIKE_ADMIN_URL'    , WP_ULIKE_URL . '/admin' 		 	);

define( 'WP_ULIKE_INC_DIR'      , WP_ULIKE_DIR . 'includes' 	 	);
define( 'WP_ULIKE_INC_URL'      , WP_ULIKE_URL . '/includes'     	);

define( 'WP_ULIKE_ASSETS_DIR'   , WP_ULIKE_DIR . 'assets' 			);
define( 'WP_ULIKE_ASSETS_URL'   , WP_ULIKE_URL . '/assets' 		 	);

/**
 * Initialize the plugin
 * ===========================================================================*/

require WP_ULIKE_INC_DIR . '/action.php';
// Register hooks that are fired when the plugin is activated or deactivated.
register_activation_hook  ( __FILE__, array( 'wp_ulike_register_action_hook', 'activate'   ) );
register_deactivation_hook( __FILE__, array( 'wp_ulike_register_action_hook', 'deactivate' ) );

if ( ! version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	add_action( 'admin_notices', 'wp_ulike_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
	add_action( 'admin_notices', 'wp_ulike_fail_wp_version' );
} elseif( ! class_exists( 'WpUlikeInit' ) ) {
	require WP_ULIKE_INC_DIR . '/plugin.php';
}

/**
 * WP ULike admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @return void
 */
function wp_ulike_fail_php_version() {
	/* translators: %s: PHP version */
	$message = sprintf( esc_html__( 'WP ULike requires PHP version %s+, plugin is currently NOT RUNNING.', WP_ULIKE_SLUG ), '5.6' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

/**
 * WP ULike admin notice for minimum WordPress version.
 *
 * Warning when the site doesn't have the minimum required WordPress version.
 *
 * @return void
 */
function wp_ulike_fail_wp_version() {
	/* translators: %s: WordPress version */
	$message = sprintf( esc_html__( 'WP ULike requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', WP_ULIKE_SLUG ), '5.0' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

/*============================================================================*/