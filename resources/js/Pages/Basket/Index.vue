<template>
  <layout :meta="meta" :auth="auth" :cartItems="cartItems">
    <h2 class="display-2 mb-4">Basket</h2>
  <v-list two-line>

    {{ cartItems }}
    
    <template v-for="product in cartItems">
      <v-list-item :key="product.id">
        <v-avatar class="mr-4">
      <span>
         <v-img :src="product.attributes['cover_img']" width="150"/>
      </span>
    </v-avatar>

           <v-list-item-title v-html="product.name"></v-list-item-title>

           <v-list-item-title>{{ product.price }}</v-list-item-title>

           <v-list-item-action>


  
    <v-icon aria-hidden="false" @click="decrement(product.id)">mdi-minus</v-icon>
    <v-text-field outlined tiny   min="0" :id="'productQty-'+product.id"   :value="product.quantity" ></v-text-field>      
    <v-icon aria-hidden="false" @click="increment(product.id)">mdi-plus</v-icon>
    
    </v-list-item-action>

            <v-list-item-title>{{ product.price * product.quantity }}</v-list-item-title>

            <v-list-item-action>
             <v-btn icon ripple @click="removeFromCart(product.id)">
               <v-icon color="red lighten-1">delete</v-icon>
             </v-btn>
           </v-list-item-action>
        </v-list-item>

        

      <!-- <v-divider v-if="index + 1 < cartItems.length" :key="index"></v-divider> -->
    </template>
  </v-list>

  
    <v-btn v-if="cartItems.length != 0" color="success" style="float:right" @click="goToPayment(cartItems)">Go to Payment</v-btn>
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
    goToPayment(cartItems){
      console.log(JSON.stringify(cartItems));
      var data = { cartItems: cartItems};
         Inertia.post("/update-cart", data, {
          onSuccess: (res) => {
            console.log(res)
          },onError: (errors) => {},
        });
    },
    increment(pid) {
      var pid = pid;
      var pCurqty = $("#productQty-"+pid).val();
      var qty = parseInt(pCurqty) + 1;
      //console.log(qty);

      
      var data = { pid: pid, qty: qty};
      

      Inertia.post("/update-cart", data, {
          onSuccess: (res) => {
            console.log(res);
            //parseInt($("#productQty-"+pid).val());
            //$("#productQty-"+pid).val(qty)
          },onError: (errors) => {},
        });
      
      
    },
    decrement(pid) {

      var pid = pid;

      console.log(pid);
      var curQty = parseInt($("#productQty-"+pid).val());
      var qty = curQty - 1;

      //$("#productQty-"+pid).val(curQty- 1);
      //var qty = parseInt($("#productQty-"+pid).val());
      var data = { pid: pid, qty: qty};
      console.log(data);
      Inertia.post("/update-cart", data, {
          onSuccess: (res) => {
            console.log(res)
          },onError: (errors) => {},
        });
      
      

      // if (this.quantity === 1) {
      //   alert("Negative quantity not allowed");
      // } else {
      //   this.quantity--;
      // }
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


