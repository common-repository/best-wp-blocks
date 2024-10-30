<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://baonguyenyam.github.io/
 * @since             1.0.0
 * @package           BEST_WP_BLOCKS
 *
 * @wordpress-plugin
 * Plugin Name:       WOW Best WP Blocks
 * Plugin URI:        https://wow-wp.com
 * Description:       Best WP Blocks help you create content blocks which can be used in posts, pages and widgets.
 * Version:           1.2.0
 * Author:            WOW WordPress
 * Author URI:        https://github.com/baonguyenyam/wp-best-wp-blocks
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       best-wp-blocks
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'BEST_WP_BLOCKS_NICENAME', 'Best WP Blocks' );
define( 'BEST_WP_BLOCKS_PREFIX', 'best_wp_blocks' );
define( 'BEST_WP_BLOCKS_VERSION', '1.2.0' );

require plugin_dir_path( __FILE__ ) . 'metabox.php';
require plugin_dir_path( __FILE__ ) . 'classes/wp_blocks_init.php';


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bn-wp-activator.php
 */
function activate_best_wp_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bn-wp-activator.php';
	BEST_WP_BLOCKS_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bn-wp-deactivator.php
 */
function deactivate_best_wp_blocks() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bn-wp-deactivator.php';
	BEST_WP_BLOCKS_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_best_wp_blocks' );
register_deactivation_hook( __FILE__, 'deactivate_best_wp_blocks' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bn-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_best_wp_blocks() {

	$plugin = new BEST_WP_BLOCKS();
	$plugin->run();

}
run_best_wp_blocks();
