/**
 * WordPress dependencies
 */
import classnames from 'classnames';
const { __ } = wp.i18n;
const {
	InnerBlocks,
	InspectorControls
} = wp.editor;
const {
	PanelBody,
	ToggleControl,
} = wp.components;

export default function edit( props ) {
	const {
		attributes: { bgApple },
		setAttributes
	} = props

	const className = classnames( props.className, {
		'bg-apple': bgApple,
	} );

	const toggleAppleStyle = bgApple => { setAttributes( { bgApple } ) };

	return [
		<InspectorControls>
			<PanelBody title={ __( 'Slide Settings', 'webslides' ) }>
				<ToggleControl
					label={ __( 'Apple-Style', 'webslides' ) }
					checked={ !! bgApple }
					onChange={ toggleAppleStyle }
				/>
			</PanelBody>
		</InspectorControls>,
		<section className={ className }>
			<div class="wrap">
				<InnerBlocks
					allowedBlocks={[
						'webslides/headline',
						'webslides/paragraph'
					]}
					template={[
						[ 'webslides/headline' ],
						[ 'webslides/paragraph' ],
					]}
				/>
			</div>
		</section>
	];
}
