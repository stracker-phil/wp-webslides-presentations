<?php
/**
 * WordPress plugin to create webslides presentations/forms.
 *
 * @package     WebslidesEditor
 * @author      Philipp Stracker
 * @license     GPL2+
 *
 * Plugin Name: Webslides Presentations
 * Plugin URI:  https://philippstracker.com
 * Description: Create professional presentations directly in WordPress using the Webslides-Framework and Gutenberg.
 * Version:     1.0.0
 * Author:      Philipp Stracker
 * Author URI:  https://philippstracker.com
 * Text Domain: webslides
 * Domain Path: /languages
 * License:     GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Stracker\WebslidesEditor;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  2.1.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  2.1.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_plugin' );

/**
 * Initializes plugin settings during plugin activation.
 */
function activate_plugin() {
	add_option( 'webslides_flush_rewrite_rules', true );
}

// Define custom post type for our presentations.
define( 'WEBSLIDES_POSTTYPE', 'webslides' );

// Enqueue JS and CSS.
require __DIR__ . '/lib/enqueue-scripts.php';

// Register meta boxes.
require __DIR__ . '/lib/meta-boxes.php';

// Custom post type.
require __DIR__ . '/lib/post-type.php';

// Register a custom page template for presentation pages.
require __DIR__ . '/lib/page-template.php';
