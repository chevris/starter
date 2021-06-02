const defaultConfig = require("@wordpress/scripts/config/webpack.config");
module.exports = {
	...defaultConfig,
	entry: {
		'front': './src/front/index.js',
		'front-rtl': './src/front-rtl/index.js',
		'editor': './src/editor/index.js',
		'editor-rtl': './src/editor-rtl/index.js',
		'main': './src/main/index.js',
		'meta': './inc/classes/meta/src/index.js',
		'customizer-controls': './inc/classes/customizer/controls/src/index.js',
	},
	output: {
		filename: '[name].js',
		path: __dirname + '/assets'
	},
	devtool: 'none',
};