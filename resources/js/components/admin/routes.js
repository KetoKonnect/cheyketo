import products from './components/products/root.vue';
import orders from './components/orders/root.vue';
import all_products from './components/products/all.vue';
import all_orders from './components/orders/all.vue';
import view_order from './components/orders/view.vue';
import view_product from './components/products/view.vue';
import dashboard from './components/dashboard.vue';
import admin from './components/admin';


export default [
    {
        path: '/',
        component: dashboard,
        name: 'admin_home',
    },

    {
        path: '/products',
        component: products,
        children: [{
                path: '',
                component: all_products,
                name: 'all_products'
            },
            {
                path: ':id',
                component: view_product,
                name: 'view_product',
                props: true
            }
        ]
    },

    {
        path: '/orders',
        component: orders,
        children: [{
                path: '',
                name: 'all_orders',
                component: all_orders
            },
            {
                path: ':id',
                name: 'view_order',
                component: view_order,
                props: true
            }
        ]
    }
]
