module.exports = {
    entry: './src/app.js',
    output: {
         path: __dirname + '/bin',
         filename: 'app.bundle.js' 
    },
    module: {
        rules: [{
            test: /\.scss$/,
            use: [
		    {loader: 'style-loader'},
		    {loader: 'css-loader'},
		    {loader: 'sass-loader'}
	    ]
        }, {
	   test: /\.css$/,
	   use: [
	   	{loader: 'style-loader'},
		{loader: 'css-loader'}
	   ]
	}]
    },
    plugins: [
    ]
};
