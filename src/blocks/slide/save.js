/**
 * WordPress dependencies
 */
import classnames from 'classnames';
const { InnerBlocks } = wp.editor;

export default function save( { attributes } ) {
	const {
		bgApple,
	} = attributes;

	const className = classnames( {
		'bg-apple': bgApple,
	} );

	return (
		<section className={ className ? className : undefined }>
			<div class="wrap">
				<InnerBlocks.Content />
			</div>
		</section>
	);
}
