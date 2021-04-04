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
    // .browserSync()
    // .browserSync('http://127.0.0.1:8000/')
    // .browserSync({
    //     //host: '192.168.10.10',
    //     host: 'localhost:8000',
    //     proxy: 'application',
    //     open: false,
    //     injectChanges: true,
    //     logSnippet: true,
    //     watchOptions: {
    //         usePolling: true,
    //         interval: 500,
    //         poll: true,
    //         ignored: /node_modules/
    //     },
    //     files: [
    //         //'app/**/*.php',
    //         //'resources/views/**/*.php',
    //         //'resources/js/app.js',
    //         'resources/js/Pages/*.vue',
    //         //'packages/mixdinternet/frontend/src/**/*.php',
    //         //'public/js/**/*.js',
    //         //'public/css/**/*.css'
    //     ]
    // })
    .vue()
    .sass('resources/sass/app.scss', 'public/css');
