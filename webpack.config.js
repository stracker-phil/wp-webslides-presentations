// This file is generic and does not require any project specific changes.

const path = require( 'path' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );

/*
 * Set different CSS extraction for editor only and common block styles.
 *
 * - blocks.common.css ... loaded on frontend and in editor
 * - blocks.editor.css ... loaded only in editor
 * - blocks.frontend.css ... loaded only on frontend
 */
const blocksCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/blocks.common.css',
} );
const editBlocksCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/blocks.editor.css',
} );
const frontendBlocksCSSPlugin = new ExtractTextPlugin( {
  filename: './assets/css/blocks.frontend.css',
} );

/*
 * Entry points for JS/CSS parsing
 *
 * - blocks.editor.js ... loaded only in editor
 * - blocks.frontend.js ... loaded only on frontend
 */
const entry = {
  './assets/js/blocks.editor': [
    './src/blocks/editor.js',
    './src/plugin/editor.js',
  ],
  './assets/js/blocks.frontend': [
    './src/blocks/frontend.js',
    './src/plugin/frontend.js',
  ],
}

// Configuration for the ExtractTextPlugin.
const extractConfig = {
  use: [
    { loader: 'raw-loader' },
    {
      loader: 'postcss-loader',
      options: {
        plugins: [ require( 'autoprefixer' ) ],
      },
    },
    {
      loader: 'sass-loader',
      query: {
        outputStyle:
          'production' === process.env.NODE_ENV ? 'compressed' : 'nested',
      },
    },
  ],
};


module.exports = {
  entry: entry,
  output: {
    path: path.resolve( __dirname ),
    filename: '[name].js',
  },
  watch: 'production' !== process.env.NODE_ENV,
  devtool: 'cheap-eval-source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /style\.s?css$/,
        use: blocksCSSPlugin.extract( extractConfig ),
      },
      {
        test: /editor\.s?css$/,
        use: editBlocksCSSPlugin.extract( extractConfig ),
      },
      {
        test: /frontend\.s?css$/,
        use: frontendBlocksCSSPlugin.extract( extractConfig ),
      },
    ],
  },
  plugins: [
    blocksCSSPlugin,
    editBlocksCSSPlugin,
    frontendBlocksCSSPlugin,
  ],
};
