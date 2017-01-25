var elixir = require('laravel-elixir');

require('laravel-elixir-vue');

elixir(function(mix){
    mix.webpack('app.js');
});
