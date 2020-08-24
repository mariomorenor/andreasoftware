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
        getUser(state){
            axios.get('user-authenticated').then(({data})=>{
                if (data) {
                    console.log(data)
                    state.user = data;
                    state.isAuth=true;
                } else { 
                    state.isAuth=false;
                }
            });
        }  
    }
})

const app = new Vue({
    el: '#app',
    router,
    store,

});
