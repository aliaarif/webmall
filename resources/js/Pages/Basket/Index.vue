<template>
  <layout :meta="meta" :auth="auth" :cartItems="cartItems">
    <h2 class="display-2 mb-4">Basket</h2>
  {{ cartItems }}
  <v-list two-line>
    <template v-for="(product, index) in cartItems">
      <v-list-item
          :key="product.id"
        >
        <v-avatar
        class="mr-4"
    >
      <span>
         <v-img src="http://webmall/img/products/default.png" width="150"/>
      </span>
    </v-avatar>
      <v-list-item-content>
            <v-list-item-title v-html="product.name"></v-list-item-title>
            <v-list-item-subtitle v-html="product.price"></v-list-item-subtitle>
          </v-list-item-content>

           <v-list-title v-html="product.price"></v-list-title>

           <v-list-item-action>
             <v-text-field  label="Quantity" reverse :value="product.quantity"></v-text-field>
           </v-list-item-action>

            <v-list-title>{{ product.price * product.quantity }}</v-list-title>

            <v-list-item-action>
             <v-btn icon ripple >
               <v-icon color="red lighten-1">delete</v-icon>
             </v-btn>
           </v-list-item-action>
        </v-list-item>

        

      <v-divider v-if="index + 1 < cartItems.length" :key="index"></v-divider>
    </template>
  </v-list>

  <v-container>
    <v-btn color="success" x-large style="float:right"></v-btn>
  </v-container>
  </layout>
</template>
<script>
import Layout from "../../Shared/Layout";
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
   
  },
};
</script>
<style>
.inertia-link {
  text-decoration: none !important;
}
</style>


