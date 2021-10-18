/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('subscribe-button', require('./components/subscribe-button').default)
Vue.component('votes', require('./components/votes').default)
require('./components/channel-uploads');

const app = new Vue({
    el: '#app',
});
