const css = require('mini-css-extract-plugin');
const path = require('path');
const webpack = require('webpack');

module.exports = {
  entry: {
    app: [
      './src/Frontend/Behavior/main.js',
      './src/Frontend/Presentation/main.sass',
    ],
  },
  output: {
    path: path.resolve(__dirname, 'public/assets'),
    filename: '[name].js'
  },
  plugins: [
    new webpack.SourceMapDevToolPlugin({}),
    new css({
      filename: '[name].css',
    }),
  ],
  module: {
    rules: [{
      test: /\.(sa|sc|c)ss$/,
      use: [
        css.loader,
        'css-loader',
        'sass-loader',
      ],
    }],
  },
};
