import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes:[
        {
            path:'/',
        },
        {
            path: '/login',
            name:'login',
            components: require('./components/views/login.vue')
        },
        // Rutas Inventario
        {
            path: '/inventario',
            name:'inventory',
            components: require('./components/views/inventory/index.vue'),
        },
        // Rutas Producto
        {
            path:'/inventario/producto',
            name:'editProduct',
            props:true,
            components: require('./components/views/product/show.vue')
        },
        {
            path:'/inventario/agregar',
            name:'createProduct',
            components: require('./components/views/product/create.vue')
        },
        // Rutas Ventas
        {
            path: '/ventas',
            name:'sales',
            components:require('./components/views/sales/index.vue')
        },
        {
            path: '/bancos',
            name:'banks',
            components:require('./components/views/banks/index.vue')
        },
        {
            path: '/cuentas',
            name:'accounts',
            components:''
        },
        // Rutas Clientes
        {
            path: '/clientes',
            name:'clients',
            components:require('./components/views/clients/index.vue')
        },
        {
            path: '/clientes/nuevo-cliente',
            name:'createClient',
            components:require('./components/views/clients/create.vue')
        },
        {
            path: '/clientes/datos-cliente',
            name:'editClient',
            props:true,
            components:require('./components/views/clients/edit.vue')
        },
        {
            path: '/comprobantes',
            name:'vouchers',
            components:''
        },
        {
            path: '/usuarios',
            name:'users',
            components:''
        },
    ],
    mode: 'history'
});