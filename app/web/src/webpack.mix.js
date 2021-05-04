const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/nunito.css','public/css')
    //.copy('node_modules/font-awesome/fonts', 'public/fonts')
    .webpackConfig(require('./webpack.config'));

mix.copyDirectory('resources/assets/fonts', 'public/fonts');

if (mix.inProduction()) {
    mix.version();
}