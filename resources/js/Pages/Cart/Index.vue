<template>
  <layout :meta="meta" :auth="auth">
    <v-card flat>
            <v-card-text>
              <h4>Your Cart</h4>
              <p align="hustify">
                <strong>You are logged in as {{ auth.name }}</strong>
              </p>
              <p align="hustify">
                The library system shows the following charges outstanding on
                your record. If you currently have any items overdue, the fines
                accruing on these will not be shown below. Fines on overdue
                loans cannot be paid until the items have been returned or
                renewed.
              </p>
              <v-data-table
                v-model="selected"
                :headers="headers"
                :items="cartItems"
                :single-select="singleSelect"
                item-key="id"
                show-select
                class="elevation-3"
              >
              </v-data-table>

              <p align="hustify" class="mt-4">
                Billing receipts will be emailed to the address we currently
                have on file for you.
              </p>
            </v-card-text>
            
          </v-card>
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
    singleSelect: false,
    selected: [],
    headers: [
      { 
        text: "Reference",
        align: "start",
        sortable: false,
        value: "session_id" 
      },
      {
        text: "Name",
        value: "name",
      },
      { 
        text: "Quantity",
        value: "quantity" 
      },
      { 
        text: "Unit Price($)",
        value: "price" 
      },
      { 
        text: "Total($)",
        value: "total" 
      }
    ],
   
  }),

  created() {
    console.log(this.cartItems);
  },
  mounted() {
    
  },
  methods: {
    sumField(key) {
          return this.selected.reduce((a, b) => parseInt(a) + parseInt((b[key] || 0)), 0)
      },
  },
};
</script>
<style>
.inertia-link {
  text-decoration: none !important;
}
</style>


