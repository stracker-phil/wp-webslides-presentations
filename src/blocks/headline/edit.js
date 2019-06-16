/**
 * WordPress dependencies
 */
import HeadingToolbar from './heading-toolbar';
import classnames from 'classnames';

const { __ } = wp.i18n;
const {
	InspectorControls,
	BlockControls,
	AlignmentToolbar,
	RichText,
} = wp.editor;
const {
	PanelBody,
} = wp.components;

export default function edit( props ) {
	const {
		attributes: { content, level, align },
		className,
		setAttributes
	} = props;
	const onChangeContent = content => { setAttributes( { content } ) };

	return [
		<BlockControls>
			<HeadingToolbar
				minLevel={ 2 }
				maxLevel={ 5 }
				selectedLevel={ level }
				onChange={ level => setAttributes({ level }) }
			/>
		</BlockControls>,
		<InspectorControls>
			<PanelBody title={ __( 'Heading Settings' ) }>
				<p>{ __( 'Level' ) }</p>
				<HeadingToolbar
					minLevel={ 1 }
					maxLevel={ 7 }
					selectedLevel={ level }
					onChange={ level => setAttributes({ level }) }
				/>
				<p>{ __( 'Text Alignment' ) }</p>
				<AlignmentToolbar
					value={ align }
					onChange={ align => {
						setAttributes({ align });
					} }
				/>
			</PanelBody>
		</InspectorControls>,
		<RichText
			className={ classnames( className, {
				[ `has-text-align-${ align }` ]: align,
				'headline': true,
			} ) }
			tagName={ 'h' + level }
			placeholder={ __( 'Your headline', 'webslides' ) }
			onChange={ onChangeContent }
			value={ content }
		/>
	];
}
