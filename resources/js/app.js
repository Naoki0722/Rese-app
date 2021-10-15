require('./bootstrap');

require('alpinejs');

window.Vue = require('vue');
var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello vue.js!'
    },
});