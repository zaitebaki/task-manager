const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require('autoprefixer');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
  watch: true,

  entry: {
    main: ['@babel/polyfill', './js/main/index.js'],
  },

  output: {
    path: path.resolve(__dirname, 'public'),
    filename: 'build/js/[name]/index.js',
    publicPath: '/',
  },

  module: {
    rules: [
      {
        test: /\.m?js$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      {
        test: /\.css$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              plugins: [autoprefixer({})],
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.s[ac]ss$/i,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              plugins: [autoprefixer({})],
              sourceMap: true,
            },
          },
          {
            loader: 'sass-loader',
            options: {sourceMap: true},
          },
        ],
      },
      {
        test: /\.pug$/i,
        use: [
          {
            loader: 'pug-loader',
            options: {
              pretty: true,
              self: true,
            },
          },
        ],
      },
      {
        test: /\.(png|jpe?g|gif|woff|woff2|ttf|otf|svg|xml)$/i,
        loader: 'file-loader',
        options: {
          name() {
            return '[path][name].[ext]';
          },
        },
      },
      {
        test: /\.json$/,
        loader: 'file-loader',
        type: 'javascript/auto',
        options: {
          name() {
            return '[path][name].[contenthash:6].[ext]';
          },
        },
      },
      {
        test: /\.vue$/,
        use: 'vue-loader'
      },
    ],
  },

  resolve: {
    alias: {
        'vue': 'vue/dist/vue.js'
    }
  },

  devServer: {
    contentBase: './public',
    watchContentBase: true,
    hot: true,
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name]/style.css',
    }),
    new VueLoaderPlugin()
  ],
};
