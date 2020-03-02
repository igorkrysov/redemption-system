/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// import {VueJsonPretty} from 'vue-json-pretty'

Vue.component('login-component', require('./components/LoginComponent.vue').default);
Vue.component('logout-component', require('./components/LogoutComponent.vue').default);
Vue.component('create-ticket-component', require('./components/CreateTicketComponent.vue').default);
Vue.component('redeem-ticket-component', require('./components/RedeemTicketComponent.vue').default);
Vue.component('vue-pretty-json', require('vue-json-pretty').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let userToken = localStorage.getItem('user-token');
console.log(window.location.pathname.indexOf("/redemption4"))
if (userToken) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + userToken;    
    // Echo.options.auth.headers.Authorization = 'Bearer ' + token;
    echoToken = 'Bearer ' + userToken; 
} else if(window.location.pathname.indexOf("/login") === -1) {
    // window.location.href = '/login';
}

const app = new Vue({
    el: '#app',
});
