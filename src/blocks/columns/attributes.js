export default {
	count: {
		type: 'array',
		source: 'children',
		selector: '.message-body',
	}
};
