export default {
	content: {
		type: 'array',
		source: 'children',
		selector: '.headline',
	},
	level: {
		type: 'number',
		default: 2,
	},
	align: {
		type: 'string',
		default: 'center',
	}
};
