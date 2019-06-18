/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

import edit from './edit';
import icon from './icon';
import save from './save';

/**
 * Register block
 */
export default registerBlockType(
	'webslides/paragraph',
	{
		title: __( 'Paragraph', 'webslides' ),
		description: __( 'Add details to your presentation.', 'webslides' ),
		category: 'common',
		parent: ['webslides/slide'],
		icon: {
			src: icon,
		},
		keywords: [
			__( 'text' )
		],
		supports: {
			className: false,
		},
		attributes: {
			align: {
				type: 'string',
			},
			content: {
				type: 'string',
				source: 'html',
				selector: 'p',
				default: '',
			},
			placeholder: {
				type: 'string',
			},
			direction: {
				type: 'string',
				enum: [ 'ltr', 'rtl' ],
			},
		},
		edit,
		save,
	}
);
