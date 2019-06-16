<?php
/**
 * Optional module to register custom post-meta values, in case your block needs to
 * store data in the postmeta table.
 *
 * @package WebslidesEditor
 */

namespace Stracker\WebslidesEditor;

add_action(
	'init',
	__NAMESPACE__ . '\register_meta_fields'
);

/**
 * Registering meta fields for block attributes that use meta storage.
 */
function register_meta_fields() {
	register_meta(
		'post',
		'plugin_block_meta', // This is the name of your meta_key.
		[
			'type'         => 'string',
			'single'       => true,
			'show_in_rest' => true,
		]
	);
}
