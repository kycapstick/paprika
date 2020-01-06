const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const autoprefixer = require("autoprefixer");

const css = {
  loader: "css-loader",
  options: {
    url: false
  }
};

const postcss = {
  loader: "postcss-loader",
  options: {
    sourceMap: true,
    plugins() {
      return [autoprefixer()];
    }
  }
};

const sass = {
  loader: "sass-loader",
};

module.exports = {
  entry: "./src/index.js",
  output: {
    filename: "bundle.js",
    path: path.resolve(__dirname, "dist")
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      },
      {
        test: /\.scss$/,
        use: [MiniCssExtractPlugin.loader, css, postcss, sass]
      },
      {
        test: /\.css$/,
        use: {
          loader: "style-loader"
        }
      },
      {
        test: /\.css$/,
        use: {
          loader: "css-loader"
        }
      }
    ]
  },
  resolve: {
    alias: {
      "@": path.resolve("src")
    }
  },
  plugins: [new MiniCssExtractPlugin("[name].css")]
};