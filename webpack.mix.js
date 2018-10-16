let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.react('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

module.exports = {
    entry: './src/app.js', output: {
        path: __dirname + '/dist', filename: 'build.js',
    }, module: {
        loaders: [
            {
                test: /\.scss$/, loader: 'style-loader!css-loader!sass-loader'
            }, {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/, use: [
                    {
                        loader: 'file-loader', options: {
                            name: '[name].[ext]', outputPath: 'fonts/'
                        }
                    }
                ]
            }
        ],
    }, watch: true,
};
