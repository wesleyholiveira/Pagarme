const ExtractTextPlugin = require("extract-text-webpack-plugin");

const extractSass = new ExtractTextPlugin({
    filename: "[name].[contenthash].css"
});

module.exports = {
    entry: './src/app.js',
    output: {
        path: '/var/www/html/Pagarme/bin',
        filename: 'app.bundle.js'
    },
    module: {
        rules: [{
            test: /\.scss|css$/,
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