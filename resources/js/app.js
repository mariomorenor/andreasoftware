/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Swal = require('sweetalert2');
require('@fortawesome/fontawesome-free/js/all');

window.bootstrapTable = require('bootstrap-table');
require("bootstrap-table/src/locale/bootstrap-table-es-ES");
window.moment = require('moment');
require('moment/locale/es');



Vue.component('app-component', require('./components/App.vue').default);
Vue.component('navbar-component', require('./components/Navbar.vue').default);

import Vuex from 'vuex'

Vue.use(Vuex)


import router from './routes';


const store = new Vuex.Store({
    state: {
        isAuth:'',
        user:''
    },
    mutations:{
        checkUser(state,response){
            if (response == 'init') {
               if (document.head.querySelector('meta[name="user"').content != '') {
                    state.isAuth=true;
                    state.user = JSON.parse(document.head.querySelector('meta[name="user"').content);
               }
               return -1;
            }
            if (response == 'logout') {
                state.isAuth=false;
                return -1;
            }
            if (response.data.username != '') {
                state.isAuth=true;
                state.user = response.data;
                return -1;
            }
        }   
    }
})

const app = new Vue({
    el: '#app',
    router,
    store,

});
