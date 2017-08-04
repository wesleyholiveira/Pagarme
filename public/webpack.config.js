module.exports = {
    context: __dirname,
    entry: '/application/public/src/app.js',
    output: {
         path: '/application/public/bin',
         filename: 'app.bundle.js' 
    },
    module: {
        rules: [{
            test: /\.scss/,
            use: [{
                loader: "style-loader",
            }, {
                loader: "css-loader"
            }, {
                loader: "sass-loader"
            }]
        }]
    },
    resolve: {
    	extensions: ['.js','.jsx','.css','.sass'],
        modules: ['node_modules']
    },
    plugins: [
    ]
};
