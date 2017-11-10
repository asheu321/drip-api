<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://aguspriyanto.net
 * @since             1.0.0
 * @package           Drip_Api
 *
 * @wordpress-plugin
 * Plugin Name:       Drip API
 * Plugin URI:        https://drip-api.gerobakdigital.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Agus Priyanto
 * Author URI:        https://aguspriyanto.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       drip-api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-drip-api-activator.php
 */
function activate_drip_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drip-api-activator.php';
	Drip_Api_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-drip-api-deactivator.php
 */
function deactivate_drip_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-drip-api-deactivator.php';
	Drip_Api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_drip_api' );
register_deactivation_hook( __FILE__, 'deactivate_drip_api' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-drip-api.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_drip_api() {

	$plugin = new Drip_Api();
	$plugin->run();

}
run_drip_api();
