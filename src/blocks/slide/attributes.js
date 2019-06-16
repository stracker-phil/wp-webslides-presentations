export default {
	message: {
		type: 'array',
		source: 'children',
		selector: '.message-body',
	},
	bgApple: {
		type: 'boolean',
		default: false,
	}
};
