var gulp = require("gulp");
var elixir = require('laravel-elixir');
var shell = require('gulp-shell');
var task = elixir.Task;

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.extend('publishAssets', function() {
    new task('publishAssets', function() {
        return gulp.src("").pipe(shell("cd ../../../ && php artisan vendor:publish --provider=\"Inoplate\\Foundation\\Providers\\InoplateServiceProvider\" --tag=public --force"));
    }).watch("resources/assets/**");
});

elixir(function(mix) {
    mix.copy('resources/assets/vendor/within-viewport', 'public/vendor/within-viewport');

    mix.coffee('inoplate.coffee')
       .coffee('datatables.extended.coffee')
       .publishAssets();
});