/**
 * WordPress dependencies
 */
import classnames from 'classnames';
const { RichText } = wp.editor;

export default function save( props ) {
	const {
		attributes: { content, level, align }
	} = props;
	const tagName = 'h' + level;

	const className = classnames( props.className, {
		[ `has-text-align-${ align }` ]: align,
		'headline': true,
	} );

	return (
		<RichText.Content
			className={ className ? className : undefined }
			tagName={ tagName }
			value={ content ? content : '' }
		/>
	);
}
