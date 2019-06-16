<?php
/**
 * Custom post type for webslide presentations.
 *
 * @package WebslidesEditor
 */

namespace Stracker\WebslidesEditor;

/**
 * Internal function that returns a list of our plugins built-in templates.
 *
 * @return array List of templates [file-name => title].
 */
function _get_templates() {
	return [
		'webslides-default.php' => 'Default Presentation',
	];
}

add_filter(
	'theme_' . WEBSLIDES_POSTTYPE . '_templates',
	__NAMESPACE__ . '\add_new_template'
);

/**
 * Adds our template to the page dropdown for v4.7+
 *
 * @param array $templates List of templates defined by the theme.
 * @return array List of templates, including our custom template.
 */
function add_new_template( $templates ) {
	$templates = array_merge( $templates, _get_templates() );
	return $templates;
}

// Remove the "Default Template" option from the page templates list.
add_filter(
	'block_editor_settings',
	__NAMESPACE__ . '\block_editor_settings',
	10, 2
);

/**
 * Modify the Gutenberg block-editor params and remove the default page template
 * option.
 *
 * @param array   $settings The block editor settings.
 * @param WP_Post $post     The currently edited post object.
 * @return array The block editor settings.
 */
function block_editor_settings( $settings, $post ) {
	if ( ! $post || WEBSLIDES_POSTTYPE !== $post->post_type ) {
		return $settings;
	}

	if ( is_array( $settings['availableTemplates'] ) ) {
		unset( $settings['availableTemplates'][''] );
	}

	return $settings;
}

// Add a filter to the template include to determine if the page has our
// template assigned and return it's path.
add_filter(
	'template_include',
	__NAMESPACE__ . '\view_project_template'
);

/**
 * Checks if the template is assigned to the page.
 *
 * @param string $template Path to the templates .php file, determined by WordPress.
 * @return string Path to the actual presentation template, when applicable.
 */
function view_project_template( $template ) {
	// Get the current post objecct.
	global $post;

	// Return default template when not displaying any post.
	if ( ! $post || WEBSLIDES_POSTTYPE !== $post->post_type ) {
		return $template;
	}

	$custom_templates = _get_templates();
	$post_template    = get_post_meta( $post->ID, '_wp_page_template', true );

	// Return default template if we don't have a custom one defined.
	if ( ! $post_template ) {
		$post_template = array_keys( $custom_templates )[0];
		update_post_meta( $post->ID, '_wp_page_template', $post_template );
	} elseif ( ! isset( $custom_templates[ $post_template ] ) ) {
		return $templates;
	}

	$file = _get_plugin_directory() . '/templates/' . $post_template;

	// Just to be safe, we check if the file exist first.
	if ( file_exists( $file ) ) {
		return $file;
	}

	// Return template.
	return $template;
}
