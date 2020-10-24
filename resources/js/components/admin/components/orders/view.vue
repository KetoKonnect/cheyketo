<template>
  <div class="container">
    <div class="row mb-2">
      <div class="col">
        <router-link :to="{ name: 'all_orders' }" class="btn btn-outline-secondary">
          <i class="fas fa-step-backward"></i>
          All Orders
        </router-link>
      </div>
    </div>

    <div class="d-flex w-100 justify-content-between">
      <h2>Order ID: {{ order.id }}</h2>
      <h4>
        status:
        <span class="text-info">{{ order.status }}</span>
      </h4>
    </div>
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Change status to:</h4>
          </div>
          <div class="list-group">
            <button
              class="list-group-item list-group-item-action active"
              @click="updateOrderStatus('new')"
            >New</button>
            <button
              class="list-group-item list-group-item-action"
              @click="updateOrderStatus('processing')"
            >Processing</button>
            <button
              class="list-group-item list-group-item-action"
              @click="updateOrderStatus('ready')"
            >Ready and available</button>
            <button
              class="list-group-item list-group-item-action"
              @click="updateOrderStatus('closed_fullfilled')"
            >Closed (Fullfilled)</button>
            <button
              class="list-group-item list-group-item-action"
              @click="updateOrderStatus('closed_unfullfilled')"
            >Closed (Unfullfilled)</button>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <h5>Customer Details</h5>
            <ul>
              <li>{{ order.customer.name }}</li>
              <li>{{ order.customer.phone_number }}</li>
              <li>{{ order.customer.email }}</li>
            </ul>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h5>
              Payment Method:
              <span class="text-info">{{ order.payment_method }}</span>
            </h5>
          </div>
          <ul class="list-group">
            <li
              class="list-group-item d-flex w-100"
              v-for="(item, index) in order.line_items"
              :key="index"
            >
              <img
                class="img-thumbnail mr-2"
                :src="getLineItemImage(index)"
                style="max-width: 100px;"
              />
              <div>
                <h5>{{ item.name }}</h5>
                {{ item.description }}
                <br />
                Qty {{ item.quantity }} &times; ${{
                item.price
                }}
                = $
              </div>
            </li>
          </ul>
          <ul class="list-group"></ul>
          <div class="card-footer">
            <h4>Subtotal: ${{ order.subtotal }}</h4>
            <h3>Total: ${{ order.total }}</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="row"></div>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      order: {},
      line_items_images: [],
    };
  },
  beforeMount() {
    axios
      .get("/admin/api/orders/" + this.id)
      .then((response) => {
        this.order = response.data.data;
        response.data.data.line_items.forEach((element, index) => {
          this.getProductsThumbnails(element.id, index);
        });
      })
      .catch((err) => {});
  },

  methods: {
    getProductsThumbnails(product_id, index) {
      axios.get("/admin/api/products/" + product_id).then((response) => {
        this.line_items_images.push({
          image: response.data.data.thumbnail,
          id: index,
        });
      });
    },

    getLineItemImage(index) {
      let result = "/";
      this.line_items_images.forEach((element) => {
        if (element.id == index) {
          result += element.image;
        }
      });
      return result;
    },

    updateOrderStatus(status) {
      Swal.fire({
        title: "Warning!",
        text: "Please confirm change of status, customer will be notified",
        icon: "warning",
        confirmButtonText: "Yes, Procced",
        showCancelButton: true,
      }).then((result) => {
        if (result.value) {
          axios
            .get("/admin/api/orders/" + this.order.id + "/update_status", {
              params: {
                status,
              },
            })
            .then((response) => {
              //show updated order
              Swal.fire({
                title: "Done",
                text: "Status updated, customer notified",
                icon: "success",
                timer: 2500,
              });
              this.order = response.data;
              this.$router.push({ name: "orders_home" });
            });
        }
      });
    },
  },
};
</script>
