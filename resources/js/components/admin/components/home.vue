<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            <router-link :to="{ name: 'all_products' }">
                                <i class="fas fa-tags"></i>
                                Products
                            </router-link>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h1 class="m-5">
                            <router-link to="/admin/orders">
                                <i class="fas fa-file-invoice-dollar"></i>
                                Orders
                            </router-link>
                        </h1>

                        Total: {{ total_orders }} New: {{ new_orders }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            orders: []
        };
    },
    beforeMount() {
        axios
            .get(process.env.MIX_ADMIN_URL + "/api/orders")
            .then(response => {
                this.orders = response.data.data;
            })
            .catch(err => {});
    },
    computed: {
        new_orders() {
            let count = 0;
            this.orders.forEach(element => {
                if (element.status == "new") {
                    count += 1;
                }
            });
            return count;
        },
        total_orders() {
            return this.orders.length;
        }
    }
};
</script>
