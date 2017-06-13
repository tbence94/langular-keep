var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.sass('app.scss', './public/css/app.css');
    mix.scripts('notes.js', './public/js/');
});