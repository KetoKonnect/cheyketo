<template>
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'admin_home' }">Home</router-link>
        </li>
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'all_products' }">All Products</router-link>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ product.name }}</li>
      </ol>
    </nav>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col">
                <img class="img-thumbnail" :src="thumbnail" />
              </div>
              <div class="col">
                <div>
                  <h4>{{ product.name }}</h4>
                  <ul>
                    <li>
                      ID
                      {{ product.id }}
                    </li>
                    <li>
                      Quantity Available:
                      {{ product.qty }}
                    </li>
                    <li>
                      Quantity Sold:
                      {{ product.quantity_sold }}
                    </li>
                    <li>Price: ${{ product.price }}</li>
                    <li>
                      Description
                      <br />
                      {{ product.description }}
                    </li>
                  </ul>
                </div>
                <div>
                  <a class="btn btn-primary btn-block" :href="edit_url">Edit</a>
                  <a
                    v-if="product.status == 'available'"
                    :href="unavailable_url"
                    class="btn btn-secondary btn-block"
                  >Mark Unavailable</a>
                  <a
                    v-if="product.status == 'unavailable'"
                    :href="available_url"
                    class="btn btn-secondary btn-block"
                  >Mark Available</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      product: {},
    };
  },
  beforeMount() {
    axios.get("/admin/api/products/" + this.id).then((response) => {
      this.product = response.data.data;
    });
  },
  computed: {
    thumbnail() {
      return "/" + this.product.thumbnail;
    },
    edit_url() {
      return "/admin/products/" + this.product.id + "/edit";
    },
    unavailable_url() {
      return "/admin/products/" + this.product.id + "/unavailable";
    },
    available_url() {
      return "/admin/products/" + this.product.id + "/available";
    },
  },
};
</script>
