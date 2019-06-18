/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

/**
 * Internal block libraries
 */
import './style.scss';
import './editor.scss';

import icon from './icon';
import attributes from './attributes';
import edit from './edit.js';
import save from './save.js';

/**
 * Register block
 */
export default registerBlockType(
	'webslides/slide',
	{
		title: __( 'Slide', 'webslides' ),
		description: __( 'A slide is always displayed in full-screen. It contains any other presentation blocks you want.', 'webslides' ),
		category: 'common', // Not "layout" because it's the only block available on page level.
		icon: {
		  	src: icon,
		},
		keywords: [
			__( 'Slide', 'webslides' ),
			__( 'Page', 'webslides' ),
			__( 'Container', 'webslides' ),
		],
		attributes,
		edit,
		save
	},
);
