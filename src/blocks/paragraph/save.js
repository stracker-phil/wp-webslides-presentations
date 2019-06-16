/**
 * WordPress dependencies
 */
const { RichText } = wp.editor;

export default function save( { attributes } ) {
	const {
		align,
		content,
		direction,
	} = attributes;

	const styles = {
		textAlign: align,
	};

	return (
		<RichText.Content
			tagName="p"
			style={ styles }
			value={ content }
			dir={ direction }
		/>
	);
}
