const mix = require('laravel-mix');
const path = require('path');

mix.js('resources/js/app.js', 'js')
   .sass('resources/sass/app.scss', 'css')
   .webpackConfig({
       resolve: {
           alias: {
               '@': path.resolve(__dirname, 'resources/js'),
           }
       }
   })
   .version();
