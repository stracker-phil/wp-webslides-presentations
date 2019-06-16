<?php
/**
 * Enqueue the Gutenberg JS/CSS files to wp-admin and front end.
 *
 * @package WebslidesEditor
 */

namespace Stracker\WebslidesEditor;

add_action(
	'enqueue_block_editor_assets',
	__NAMESPACE__ . '\enqueue_block_editor_assets',
	800
);

/**
 * Enqueue block editor only JavaScript and CSS.
 */
function enqueue_block_editor_assets() {
	if ( WEBSLIDES_POSTTYPE !== get_post_type() ) {
		return;
	}

	dequeue_theme_styles();

	$style_path  = '/assets/css/blocks.editor.css';
	$script_path = '/assets/js/blocks.editor.js';

	// Enqueue the bundled block JS file.
	wp_enqueue_script(
		'webslides-block-editor',
		_get_plugin_url() . $script_path,
		[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor' ],
		filemtime( _get_plugin_directory() . $script_path )
	);

	// Enqueue optional editor only styles.
	if ( file_exists( _get_plugin_directory() . $style_path ) ) {
		wp_enqueue_style(
			'webslides-block-editor',
			_get_plugin_url() . $style_path,
			[],
			filemtime( _get_plugin_directory() . $style_path )
		);
	}
}

add_action(
	'enqueue_block_assets',
	__NAMESPACE__ . '\enqueue_assets',
	800
);

/**
 * Enqueue front end and editor JavaScript and CSS assets.
 */
function enqueue_assets() {
	if ( WEBSLIDES_POSTTYPE !== get_post_type() ) {
		return;
	}

	$style_path = '/assets/css/blocks.common.css';

	if ( file_exists( _get_plugin_directory() . $style_path ) ) {
		wp_enqueue_style(
			'webslides-block-common',
			_get_plugin_url() . $style_path,
			null,
			filemtime( _get_plugin_directory() . $style_path )
		);
	}
}

add_action(
	'wp_enqueue_scripts',
	__NAMESPACE__ . '\enqueue_frontend_assets',
	800
);

/**
 * Enqueue frontend JavaScript and CSS assets.
 */
function enqueue_frontend_assets() {
	if ( WEBSLIDES_POSTTYPE !== get_post_type() ) {
		return;
	}

	dequeue_theme_styles();

	$webslides_path = '/assets/css/webslides.css';
	$style_path     = '/assets/css/blocks.frontend.css';
	$script_path    = '/assets/js/blocks.frontend.js';

	wp_enqueue_script(
		'webslides-block-front',
		_get_plugin_url() . $script_path,
		[],
		filemtime( _get_plugin_directory() . $script_path )
	);

	if ( file_exists( _get_plugin_directory() . $style_path ) ) {
		wp_enqueue_style(
			'webslides-block-front',
			_get_plugin_url() . $style_path,
			null,
			filemtime( _get_plugin_directory() . $style_path )
		);
	}

	wp_enqueue_style(
		'webslides-styles-front',
		_get_plugin_url() . $webslides_path,
		null,
		filemtime( _get_plugin_directory() . $webslides_path )
	);
}

add_filter(
	'use_block_editor_for_post',
	__NAMESPACE__ . '\remove_themes_editor_styles',
	800
);

/**
 * Removes editor styles which the theme injected into the wp_editor component.
 *
 * @param bool $use_block_editor Not used by this function.
 * @return bool Simply return the unfiltered input param.
 */
function remove_themes_editor_styles( $use_block_editor ) {
	if ( WEBSLIDES_POSTTYPE === get_post_type() ) {
		remove_editor_styles();
	}

	return $use_block_editor;
}

/**
 * Dequeue all stylesheets that are inside the themes directory.
 */
function dequeue_theme_styles() {
	global $wp_styles;
	global $wp_theme_directories;

	// Most likely $theme_paths is always ["wp-content/themes"], but better be sure.
	$theme_paths = [];
	foreach ( $wp_theme_directories as $dir ) {
		$theme_paths[] = str_replace( ABSPATH, '', $dir );
	}

	// Loop all registered styles and remove stylesheets in "wp-content/themes".
	foreach ( $wp_styles->registered as $handle => $style ) {
		foreach ( $theme_paths as $theme_dir ) {
			if ( strpos( $style->src, $theme_dir ) ) {
				wp_dequeue_style( $handle );
			}
		}
	}
}
