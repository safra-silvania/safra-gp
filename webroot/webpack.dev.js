const path = require("path");
const merge = require("webpack-merge");
const webpackConfig = require("./webpack.config");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const mergeConfig = {
    mode: "development",
    devtool: "cheap-eval-source-map",
    watch: true,
    plugins: [
        new MiniCssExtractPlugin({
            filename: "main.css",
        }),
    ],
};

const bundles = webpackConfig.map((config) => merge(config, mergeConfig));

module.exports = bundles;
