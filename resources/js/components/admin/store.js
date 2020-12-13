export default {
    state: {
        Orders: [],
        Products: []
    },
    mutations: {
        updateOrders (state, payload) {
            state.Orders = payload
        },

        updateProducts (state, payload) {
            state.Products = payload
        }
    },

    getters: {
        ordersCount (state) {
            return state.Orders.length
        },

        productsCount (state) {
            return state.Products.length
        },

        newOrders (state) {
            return state.Orders.filter(order => order.status == "new")
        },

        newOrdersCount (state, getters) {
            return getters.newOrders.length
        },

        allProducts (state) {
            return state.Products
        },

        allOrders (state) {
            return state.Orders
        }
    },

    actions: {
        loadOrders (context) {
            axios
            .get("/admin/api/orders")
            .then((response) => {
                context.commit('updateOrders', response.data.data);
            })
            .catch((err) => {});
        },

        loadProducts (context) {
            axios.get("/api/products").then((response) => {
                context.commit('updateProducts', response.data.data);
            }).catch((e) => {

            })
        }
    }
}
