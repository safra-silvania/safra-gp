const merge = require("webpack-merge");
const webpackConfig = require("./webpack.config");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const UglifyEsPlugin = require("uglify-es-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

const mergeConfig = {
    mode: "production",
    optimization: {
        minimizer: [
            new UglifyEsPlugin({
                sourceMap: true,
                output: {
                    comments: false,
                },
            }),
            new OptimizeCSSAssetsPlugin({}),
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "main.css",
        }),
    ],
};

const bundles = webpackConfig.map((config) => merge(config, mergeConfig));

module.exports = bundles;
