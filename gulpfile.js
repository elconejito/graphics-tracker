var elixir = require('laravel-elixir');
var jsList = [
    '../assets/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js',
    '../assets/vendor/smalot-bootstrap-datetimepicker/js/bootstrap-datetimepicker.js',
    '../assets/vendor/Chart.js/Chart.js',
    '_main.js'
];
var cssList = [
    '../assets/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
    '../assets/vendor/smalot-bootstrap-datetimepicker/css/bootstrap-datetimepicker.css',
    'app.css'
];

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.less('app.less', 'resources/css')
        .scripts(jsList, 'public/js/main.js')
        .styles(cssList, 'public/css/app.css');
});