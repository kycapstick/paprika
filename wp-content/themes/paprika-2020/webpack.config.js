const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const autoprefixer = require("autoprefixer");

const css = {
	loader: "css-loader",
	options: {
		url: false,
	},
};

const postcss = {
	loader: "postcss-loader",
	options: {
		sourceMap: true,
		plugins() {
			return [autoprefixer()];
		},
	},
};

const sass = {
	loader: "sass-loader",
	options: {
		sourceMap: true,
		outputStyle: "compressed",
	},
};

module.exports = {
	entry: {
		main: ["@babel/polyfill", "./src/js/index.js"],
		admin: ["./src/js/admin.js"],
		gutenberg: ["./src/js/gutenberg.js"],
	},
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, "dist"),
	},
	externals: {
		jquery: "jQuery",
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: "babel-loader",
				options: {
					presets: ["@babel/preset-env"],
				},
			},
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, css, postcss, sass],
			},
			{
				test: /\.css$/,
				use: {
					loader: "style-loader",
				},
			},
			{
				test: /\.css$/,
				use: {
					loader: "css-loader",
				},
			},
		],
	},
	resolve: {
		alias: {
			"@": path.resolve("src"),
		},
	},
	plugins: [new MiniCssExtractPlugin("[name].css")],
};
