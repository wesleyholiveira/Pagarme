const ExtractTextPlugin = require("extract-text-webpack-plugin");
const IconfontWebpackPlugin = require('iconfont-webpack-plugin');

const extractSass = new ExtractTextPlugin({
    filename: "[name].[contenthash].css"
});

module.exports = {
    entry: './src/app.js',
    output: {
        path: 'C:\\xampp\\htdocs\\Pagarme\\public\\bin',
        filename: 'app.bundle.js'
    },
    module: {
        rules: [{
            test: /\.scss$/,
            use: [{
                loader: "style-loader"
            }, {
                loader: "css-loader"
            }, {
                loader: "sass-loader"
            }]
        }]
    },
    plugins: [
        extractSass
    ]
};