/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
window.Vue = require("vue");

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Vuex from 'vuex'
Vue.use(Vuex)
import Store from './store'
const store = new Vuex.Store(Store)
console.log(store);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

import routes from './routes';

const router = new VueRouter({
    mode: 'history',
    base: '/admin/',
    routes: routes,
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import vueCountryRegionSelect from "vue-country-region-select";
Vue.use(vueCountryRegionSelect);

const app = new Vue({
    el: "#app",
    router,
    store,
    data() {
        return {
            selected: "",
            country: "BS",
            region: "",
            edit_image: false,
        };
    }
});
