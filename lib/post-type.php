<?php
/**
 * Custom post type for webslide presentations.
 *
 * @package WebslidesEditor
 */

namespace Stracker\WebslidesEditor;

add_action(
	'init',
	__NAMESPACE__ . '\register_webslides_posttype'
);

/**
 * Register the custom post type to display our webslides presentations.
 */
function register_webslides_posttype() {
	$slug = 'presentation';

	$labels = [
		'name'               => __( 'Presentations', 'webslides' ),
		'singular_name'      => __( 'Presentation', 'webslides' ),
		'menu_name'          => __( 'Presentations', 'webslides' ),
		'parent_item_colon'  => __( 'Parent Presentation', 'webslides' ),
		'all_items'          => __( 'Presentations', 'webslides' ),
		'view_item'          => __( 'View Presentation', 'webslides' ),
		'add_new_item'       => __( 'Add Presentation', 'webslides' ),
		'add_new'            => __( 'New Presentation', 'webslides' ),
		'edit_item'          => __( 'Edit Presentation', 'webslides' ),
		'update_item'        => __( 'Update Presentation', 'webslides' ),
		'search_items'       => __( 'Search Presentations', 'webslides' ),
		'not_found'          => __( 'No Presentation found', 'webslides' ),
		'not_found_in_trash' => __( 'No Presentations found in Trash', 'webslides' ),
	];

	$posttype = [
		'label'               => 'Presentations',
		'labels'              => $labels,
		'description'         => __( 'Webslides presentations', 'webslides' ),
		'supports'            => [ 'title', 'editor', 'page-attributes' ],
		'taxonomies'          => [],
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_json'        => true,
		'query_var'           => true,
		'rewrite'             => [
			'slug'       => $slug,
			'with_front' => true,
		],
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 26,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
		'menu_icon'           => 'data:image/svg+xml;base64,' . base64_encode(
			'<svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M560 0H16C7.16 0 0 7.16 0 16v32c0 8.84 7.16 16 16 16h16v256c0 17.67 14.33 32 32 32h192v34.75l-75.31 75.31c-6.25 6.25-6.25 16.38 0 22.63l22.62 22.62c6.25 6.25 16.38 6.25 22.63 0L288 445.25l62.06 62.06c6.25 6.25 16.38 6.25 22.63 0l22.62-22.62c6.25-6.25 6.25-16.38 0-22.63L320 386.75V352h192c17.67 0 32-14.33 32-32V64h16c8.84 0 16-7.16 16-16V16c0-8.84-7.16-16-16-16zm-80 288H96V64h384v224z"></path></svg>'
		),
	];

	register_post_type( WEBSLIDES_POSTTYPE, $posttype );

	// Flush rewrite rules, after the post type is registered the first time.
	if ( get_option( 'webslides_flush_rewrite_rules' ) ) {
		flush_rewrite_rules();
		delete_option( 'webslides_flush_rewrite_rules' );
	}
}

add_filter(
	'allowed_block_types',
	__NAMESPACE__ . '\limit_allowed_blocks',
	10, 2
);

/**
 * Limit Gutenberg blocks available in the Webslides post type.
 *
 * @param array   $allowed_block_types List of default blocks.
 * @param WP_Post $post                The post details.
 * @return array List of actually allowed blocks.
 */
function limit_allowed_blocks( $allowed_block_types, $post ) {
	if ( ! $post || WEBSLIDES_POSTTYPE !== $post->post_type ) {
		return $allowed_block_types;
	}

	return [
		'webslides/slide',
		'webslides/headline',
		'webslides/paragraph',
	];
}
