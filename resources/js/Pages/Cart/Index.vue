<template>
  <layout :meta="meta" :auth="auth" :cartItems="cartTotalQuantity">
    <h2 class="display-6">Basket</h2>
  <v-list two-line>
    <template v-for="product in cartItems">
      <v-list-item :key="product.id">
        <v-avatar class="mr-4">
          <span>
            <v-img :src="product.attributes['cover_img']" width="150"/>
          </span>
        </v-avatar>
        
        <v-list-item-title v-html="product.name"></v-list-item-title>
        <v-list-item-title>{{ product.price }}</v-list-item-title>
        
        <v-icon aria-hidden="false"  @click="decrement(product.id)" color="primary" class="mr-2">mdi-minus</v-icon>
        <v-text-field  solo dense  min="1" :id="'productQty-'+product.id"   :value="product.quantity" class="mt-6" ></v-text-field>      
        <v-icon aria-hidden="false" @click="increment(product.id)" color="primary" class="ml-2">mdi-plus</v-icon>
      
        <v-list-item-title>{{ product.price * product.quantity }}</v-list-item-title>
        
        <v-btn icon ripple @click="removeFromCart(product.id)">
          <v-icon color="red lighten-1">delete</v-icon>
        </v-btn>
           
        </v-list-item>

         <!-- <v-divider :key="product.id"></v-divider> -->

      <!-- <v-divider v-if="index + 1 < cartItems.length" :key="index"></v-divider> -->
    </template>
  </v-list>

  
    <v-btn v-if="cartItems.length != 0" color="success">
      <inertia-link href="/checkout" class="inertia-link">Proceed to checkout</inertia-link>
      </v-btn>
    <v-btn v-else color="ingo" style="float:right">
      <inertia-link href="/" class="inertia-link">Continue Shopping</inertia-link>
    </v-btn>
  
  </layout>
</template>
<script>
import Layout from "../../Shared/Layout";
import { Inertia } from "@inertiajs/inertia";
export default {
  props: ['meta', 'auth', 'cartItems', 'cartTotalQuantity'],
  components: {
    Layout,
  },
  data: () => ({

  }),

  created() {
    console.log(this.cartItems);
  },
  mounted() {
    
  },
  methods: {
    removeFromCart(pid){
      this.$parent.loading = true;
      var data = { pid: pid};
       Inertia.post("/remove-from-cart", data, {
          onSuccess: (res) => {
            //this.$parent.loading = false;
          },onError: (errors) => {},
        });
    },
    increment(pid) {
      var pid = pid;
      var qty = $('#productQty-'+pid).val();  
      var data = { pid: pid, qty: qty, action: 'plus'};
      Inertia.post("/update-cart", data, {
          onSuccess: (res) => {},
          onError: (errors) => {},
        });
    },
    decrement(pid) {
      var pid = pid;   
      var qty = $('#productQty-'+pid).val();         
      var data = { pid: pid, qty: qty, action: 'minus'};
      console.log(data);
      Inertia.post("/update-cart", data, {
          onSuccess: (res) => {},
          onError: (errors) => {},
      });
    }
  },
};
</script>
<style>
.inertia-link {
  text-decoration: none !important;
}
.quantity {
  max-width: 150px;
  width: 100%;
}

.quantity input {
  text-align: center;
}
</style>


