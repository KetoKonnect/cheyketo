<template>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin_home' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    All Orders
                </li>
            </ol>
        </nav>

        <h2>All Orders</h2>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Placed</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="order in orders" :key="order.id">
                                        <td>{{ order.id }}</td>
                                        <td>{{ order.customer.name }}</td>
                                        <td>${{ order.total }}</td>
                                        <td>{{ order.status }}</td>
                                        <td>{{ order.created_at }}</td>
                                        <td>
                                            <a
                                                :href="view_url(order.id)"
                                                class="btn btn-outline-secondary"
                                            >
                                                view
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        axios.get(process.env.MIX_ADMIN_URL + "/api/orders").then(response => {
            this.orders = response.data.data;
        });
    },
    data() {
        return {
            orders: []
        };
    },
    methods: {
        view_url(order_id) {
            return process.env.MIX_ADMIN_URL + "/orders/" + order_id;
        }
    }
};
</script>
