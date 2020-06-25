<template>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin_home' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    All Products
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h2>All Products</h2>
                        <a
                            :href="add_products_url"
                            class="btn btn-outline-secondary"
                            >Add a Product</a
                        >
                        <div class="table-responsive mt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Qty Avail.</th>
                                        <th scope="col">Date created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(product, index) in products"
                                        :key="product.id"
                                    >
                                        <td>{{ product.id }}</td>
                                        <td>{{ product.name }}</td>
                                        <td>{{ product.description }}</td>
                                        <td>{{ product.qty }}</td>
                                        <td>
                                            {{ product.created_at }}
                                        </td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'view_product',
                                                    params: { id: product.id }
                                                }"
                                                :disabled="disabled"
                                                class="btn btn-outline-secondary"
                                            >
                                                view
                                            </router-link>
                                            <button
                                                @click="
                                                    delete_this(
                                                        product.id,
                                                        index
                                                    )
                                                "
                                                class="btn btn-outline-danger"
                                                :disabled="disabled"
                                            >
                                                Delete
                                            </button>
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
        axios
            .get(process.env.MIX_ADMIN_URL + "/api/products")
            .then(response => {
                this.products = response.data.data;
            });
    },
    data() {
        return {
            products: [],
            disabled: false
        };
    },
    computed: {
        add_products_url() {
            return process.env.MIX_ADMIN_URL + "/products/create";
        }
    },
    methods: {
        view_url(product_id) {
            return process.env.MIX_ADMIN_URL + "/products/" + product_id;
        },
        delete_this(product_id, index) {
            this.disabled = true;
            Swal.fire({
                title: "Delete?",
                text: "Please confirm Delete",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete this"
            }).then(result => {
                if (result.value) {
                    axios
                        .get(
                            process.env.MIX_ADMIN_URL +
                                "/api/products/" +
                                product_id +
                                "/delete"
                        )
                        .then(response => {
                            this.products.splice(index, 1);
                            this.disabled = false;
                            Swal.fire({
                                title: "Product Deleted",
                                text: "Product completely deleted",
                                icon: "success"
                            });
                        });
                }
            });
        }
    }
};
</script>
