<template>
  <layout :meta="meta" :auth="auth" :cartItems="cartItems.length">


 
    <v-row no-gutters>
      <v-col
       cols="12"
        sm="4"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
           <h2 class="display-12">Cart Items</h2>
          <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Name
          </th>
          <th class="text-left">
            Price
          </th>
          <th class="text-left">
            Quantity
          </th>
          <th class="text-left">
            Total
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="product in cartItems"
          :key="product.id"
        >
        <td>
           <v-avatar class="mr-1">
          <span>
            <v-img :src="product.attributes['cover_img']" width="150"/>
          </span>
        </v-avatar> {{ product.name }}
        </td>
          <td>{{ product.price }}</td>
          <td>{{ product.quantity }}</td>
          <td>{{ product.price * product.quantity }}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
        </v-card>
      </v-col>



      <v-col
       cols="12"
        sm="4"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
           <h2 class="display-12">Cart Items</h2>

        </v-card>
      </v-col>
          <v-col
       cols="12"
        sm="4"
      >
        <v-card
          class="pa-2"
          outlined
          tile
        >
           <h2 class="display-12">Cart Items</h2>

        </v-card>
      </v-col>
    </v-row>
  


  


 
  

  
    <v-btn v-if="cartItems.length != 0" color="success">
      <inertia-link href="/checkout" class="inertia-link">Checkout</inertia-link>
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
  props: ["meta", "auth", "cartItems"],
  components: {
    Layout,
  },
  data: () => ({
    desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
          },
          {
            name: 'Eclair',
            calories: 262,
          },
          {
            name: 'Cupcake',
            calories: 305,
          },
          {
            name: 'Gingerbread',
            calories: 356,
          },
          {
            name: 'Jelly bean',
            calories: 375,
          },
          {
            name: 'Lollipop',
            calories: 392,
          },
          {
            name: 'Honeycomb',
            calories: 408,
          },
          {
            name: 'Donut',
            calories: 452,
          },
          {
            name: 'KitKat',
            calories: 518,
          },
        ],
      
  }),

  created() {
    console.log(this.cartItems);
  },
  mounted() {
    
  },
  methods: {
    removeFromCart(productId){
      var data = { productId: productId};
       Inertia.post("/remove-from-cart", data, {
          onSuccess: (res) => {},onError: (errors) => {},
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


