/**
 * Webpack configuration.
 */

const path = require( 'path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' );
const cssnano = require( 'cssnano' );
const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
const StyleLintPlugin = require( 'stylelint-webpack-plugin' );

// JS Directory path.
const JS_DIR = path.resolve( __dirname, 'src/js' );
const BUILD_DIR = path.resolve( __dirname, 'build' );

module.exports = {

	entry: {
		tab: JS_DIR + '/tab.js',
	},

	output: {
		path: BUILD_DIR,
		filename: 'js/[name].js'
	},

	devtool: false,

	module: {
		rules: [
			{
				enforce: 'pre',
				test: /\.(js|jsx)$/,
				exclude: /node_modules/,
				use: 'eslint-loader'
			},
			{
				test: /\.js$/,
				include: [ JS_DIR ],
				exclude: /node_modules/,
				use: 'babel-loader'
			},
			{
				test: /\.scss$/,
				exclude: /node_modules/,
				use: [
					MiniCssExtractPlugin.loader,
					'css-loader',
					'postcss-loader',
					'sass-loader'
				]
			},
		]
	},

	optimization: {
		minimizer: [
			new OptimizeCssAssetsPlugin( {
				cssProcessor: cssnano
			} ),

			new UglifyJsPlugin( {
				cache: false,
				parallel: true,
				sourceMap: false
			} )
		]
	},

	plugins: [
		new CleanWebpackPlugin(),

		new MiniCssExtractPlugin( {
			filename: 'css/[name].css'
		} ),

		new StyleLintPlugin( {
			'extends': 'stylelint-config-wordpress/scss'
		} )
	],

	externals: {
		jquery: 'jQuery'
	}
};
