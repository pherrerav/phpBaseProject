var path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CompressionPlugin = require("compression-webpack-plugin");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

module.exports = (env = {}, argv = {}) => {
	const isProd = argv.mode === "production";

	const config = {
		mode: argv.mode || "development",

		optimization: {
			minimizer: [
				new UglifyJsPlugin({ cache: true, parallel: true, sourceMap: false }),
				new OptimizeCSSAssetsPlugin({})
			]
		},
		entry: {
			main: "./assets/src/main.js"
			//authentication: "./assets/src/authentication.js"
		},
		output: {
			filename: isProd ? "bundle-[chunk/Hash].js" : "[name].js",
			path: path.resolve(__dirname, "assets/dist"),
			publicPath: "/"
		},
		plugins: [
			new MiniCssExtractPlugin({
				filename: isProd ? "style-[contenthash].css" : "main.css",
				path: path.resolve(__dirname, "assets/dist"),
				publicPath: "/"
			}),
			new CompressionPlugin({
				filename: "[path].gz[jquery]",
				algorithm: "gzip",
				test: "/.js$|.css$|.html$|.eot?.+$|.ttf?.+$|.woff?.+$|.svg?.+$/",
				threshold: 10240,
				minRatio: 0.8
			})
		],
		module: {
			rules: [
				{
					test: /\.js/,
					exclude: /node_modueles/,
					use: {
						loader: "babel-loader"
					}
				},
				{
					test: /\.(sa|sc|c)ss$/,
					use: ["style-loader", MiniCssExtractPlugin.loader, "css-loader"]
				}
			]
		}
	};
	return config;
};
