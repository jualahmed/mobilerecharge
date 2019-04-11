
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

	import PrettyCheck from 'pretty-checkbox-vue/check';

    Vue.component('p-check', PrettyCheck);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Recharge', require('./components/Recharge.vue').default);
Vue.component('select-country', require('./components/SelectCountry.vue').default);
Vue.component('twilliosms', require('./components/twilliosms.vue').default);
Vue.component('dingrecharge', require('./components/dingrecharge.vue').default);
Vue.component('StepOne', require('./components/StepOne.vue').default);
Vue.component('dingrecharge1', require('./components/dingrecharge1.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
