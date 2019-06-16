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
import attributes from './attributes.js';
import edit from './edit.js';
import save from './save.js';

/**
 * Register block
 */
export default registerBlockType(
	'webslides/headline',
	{
		title: __( 'Headline', 'webslides' ),
		description: __( 'Display a Headline.', 'webslides' ),
		category: 'common',
		parent: ['webslides/slide'],
		icon: {
		  	src: icon,
		},
		keywords: [
			__( 'Headline', 'webslides' ),
			__( 'Title', 'webslides' ),
		],
		attributes,
		edit,
		save,
	},
);
