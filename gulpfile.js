var elixir = require('laravel-elixir');

elixir(function (mix) {

    mix.styles('./node_modules/angular-material/angular-material.css', './public/css/angular.css');

    mix.sass('app.scss', './public/css/app.css');

    mix.scripts([
        './node_modules/angular/angular.js',
        './node_modules/angular-ui-router/release/angular-ui-router.min.js',
        './node_modules/angular-aria/angular-aria.js',
        './node_modules/angular-animate/angular-animate.js',
        './node_modules/angular-material/angular-material.js',
        './node_modules/angular-relative-date/dist/angular-relative-date.js'
    ], './public/js/angular.js');

    mix.scripts([
        'keep.js',
        'notes.js',
        'settings.js'
    ], './public/js/app.js');

    mix.copy('./node_modules/material-design-icons/iconfont', './public/css/icons');

});