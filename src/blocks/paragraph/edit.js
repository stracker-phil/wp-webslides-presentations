/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const {
	AlignmentToolbar,
	BlockControls,
	InspectorControls,
	RichText,
} = wp.editor;
const { createBlock } = wp.blocks;

const name = 'webslides/paragraph';

export default function edit( props ) {
	const {
		attributes,
		setAttributes,
		mergeBlocks,
		onReplace,
		className,
	} = props;

	const {
		align,
		content,
		placeholder,
	} = attributes;

	return [
		<BlockControls>
			<AlignmentToolbar
				value={ align }
				onChange={align => { setAttributes({ align }); } }
			/>
		</BlockControls>,
		<InspectorControls>
		</InspectorControls>,
		<RichText
			identifier="content"
			tagName="p"
			className={ classnames( 'wp-block-webslides-paragraph', className ) }
			style={ {
				textAlign: align,
			} }
			value={ content }
			onChange={content => { setAttributes({ content }); } }
			onSplit={value => {
				if ( ! value ) {
					return createBlock( name );
				}

				return createBlock( name, {
					...attributes,
					content: value,
				} );
			} }
			onMerge={ mergeBlocks }
			onReplace={ onReplace }
			onRemove={ onReplace ? () => onReplace( [] ) : undefined }
			aria-label={ content ? __( 'Paragraph block' ) : __( 'Empty block; start writing or type forward slash to choose a block' ) }
			placeholder={ placeholder || __( 'Start writing or type / to choose a block' ) }
		/>
	];
}
