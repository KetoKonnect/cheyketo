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
            <p>Total: {{ total_products }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card text-center">
          <div class="card-body">
            <h1 class="m-5">
              <router-link :to="{name: 'all_orders'}">
                <i class="fas fa-file-invoice-dollar"></i>
                Orders
              </router-link>
            </h1>
            <p>Total: {{ total_orders }} New: {{ new_orders }}</p>
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
      orders: [],
    };
  },
  beforeMount() {
    this.$store.dispatch('loadOrders')
    this.$store.dispatch('loadProducts')
  },
  computed: {
    new_orders() {
      return this.$store.getters.newOrdersCount
    },
    total_orders() {
      return this.$store.getters.ordersCount;
    },
    total_products() {
        return this.$store.getters.productsCount;
    }
  },
};
</script>
