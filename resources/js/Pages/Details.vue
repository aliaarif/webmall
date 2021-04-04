<template>
  <layout :meta="meta" :auth="auth">
    <v-card>
      <v-toolbar color="primary" dark>
        <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
        <v-toolbar-title>{{ tabTitle }} </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-title>Library Payments</v-toolbar-title>
        <template v-slot:extension centered>
          <v-tabs v-model="currentItem" slider-color="white" v-if="auth">
            <v-tab
              v-for="(item, index) in authTabs"
              :key="index"
              :href="'#tab-' + item"
              class="inertia-link"
              @click="setTitle(item)"
            >
              <span class="mdi mdi-currency-gbp"></span> {{ item }}
            </v-tab>
          </v-tabs>

          <v-tabs v-model="currentItem" slider-color="white" v-else>
            <v-tab
              v-for="(item, index) in guestTabs"
              :key="index"
              :href="'#tab-' + item"
              class="inertia-link"
              @click="setTitle(item)"
            >
              <span
                :class="
                  item !== 'Login Panel'
                    ? item === 'Library Charges'
                      ? 'mdi mdi-checkbox-multiple-marked-outline'
                      : 'mdi mdi-currency-gbp'
                    : 'mdi mdi-login'
                "
              ></span>
              {{ item }}
            </v-tab>
          </v-tabs>
        </template>
      </v-toolbar>

      <v-tabs-items v-model="currentItem" v-if="auth">
        <v-tab-item v-for="item in authTabs" :key="item" :value="'tab-' + item">
          <v-card flat>
            <v-card-text v-if="item === 'Library Charges'">
              <h4>Library Payments</h4>
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
                :items="auth.charges"
                :single-select="singleSelect"
                item-key="id"
                show-select
                class="elevation-3"
              >
                <template v-slot:top>
                  <v-toolbar flat color="white" v-if="selected.length > 0">
                    <v-toolbar-title>{{ tabTitle }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                  <v-btn color="primary" dark @click="next">
                    {{ labelNext }}
                  </v-btn>
                </v-toolbar>
                </template>
              </v-data-table>

              <p align="hustify" class="mt-4">
                Billing receipts will be emailed to the address we currently
                have on file for you.
              </p>
            </v-card-text>
            <v-card-text v-if="item == 'Make Payments'">
              <h4>Library Payments</h4>
              <p align="hustify">
                <strong>You are logged in as {{ auth.name }}</strong>
              </p>
              <p align="hustify" >
                The library system shows the following charges outstanding on
                your record. If you currently have any items overdue, the fines
                accruing on these will not be shown below. Fines on overdue
                loans cannot be paid until the items have been returned or
                renewed.
              </p>

                <v-data-table
                v-model="selected"
                :headers="headers2"
                :items="selected"
                item-key="id"
                class="elevation-3"
              >
                <template v-slot:top>
                  <v-toolbar flat color="white" v-if="selected.length > 0">
                    <v-toolbar-title>{{ tabTitle }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                  <v-btn color="primary" dark @click="continueToPayment">
                     {{ labelContinueToPayment }}
                  </v-btn>
                </v-toolbar>
                </template>
               
                  <template slot="body.append">
                    <tr class="primary--text">
                      <th colspan="5"> Grand Total: {{ sumField("total") }}</th>
                    </tr>
                </template>

              </v-data-table>

              <p align="hustify" class="mt-4">
                Please check your information for errors and try again. If you
                continue to experience problems, please contact us using the
                Comments and Questions.
              </p>
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
    <div id="card-element">

        </div>
  </layout>
</template>
<script>
import Layout from "../Shared/Layout";
import { StripeCheckout } from '@vue-stripe/vue-stripe';
import { Inertia } from "@inertiajs/inertia";
export default {
  props: ["meta", "auth", "tab", "suitsItems", "responseStatus", "sessions"],
  components: {
    Layout,
    StripeCheckout
  },
  data: () => ({
    tabTitle: "Login Panel",
    currentItem: "tab-Login Panel",
    authTabs: ["Library Charges", "Make Payments"],
    guestTabs: ["Login Panel", "Library Charges", "Make Payments"],
    stripeAPIToken: process.env.MIX_STRIPE_KEY ?? 'pk_test_518CNU9LvxK8H85YvtLuUfO5sCn5fuJuajntCa2XhRm7wS79Onh7XIW2ZJKt3B0Ouc91tgZawxlsMtuP54hrxBcYW00HHcQZKPy',
    stripe: '',
    elements: '',
    card: '',
    //pay:false,
    username: "",
    password: "",
    labelLogin: 'Login',
    btnStatusLogin: false,
    labelNext  : 'Next',
    labelContinueToPayment: 'Continue To Payment',
    error: false,
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
    selected2: [],
    headers2: [
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
    if (this.auth && this.tabTitle === "Login Panel") {
      this.currentItem = "tab-" + this.tab;
      this.setTitle(this.tab);
      this.authTabs.splice(this.authTabs.indexOf(this.tab), -1);
      this.authTabs.slice(0, 1);
    }
  },
  mounted(){
            this.includeStripe('js.stripe.com/v3/', function(){
                this.configureStripe();
            }.bind(this) );
        },
  methods: {
    login() {
      
      let validate =
        this.username !== "" && this.password !== "" ? true : false;
      if (validate) {
        this.labelLogin = 'Processing...';
        
        var data = {
          username: this.username,
          password: this.password,
        };
        Inertia.post("/library-payments/verify", data, {
          onSuccess: () => {
            this.btnStatusLogin = true;
            // Handle success event
            this.responseStatus === false
              ? (this.error = true)
              (this.btnStatusLogin = false)
              : this.responseStatus;        
          },
          onError: (errors) => {
            // Handle validation errors
             this.labelLogin = 'Login';
              this.btnStatusLogin = false;
          },
        });
       
      } else {
        this.error = true;
        this.labelLogin = 'Login';
        this.btnStatusLogin = false;
      }
    },
    next(){
      console.log(this.selected);
      this.currentItem = "tab-Make Payments";
      this.setTitle('Make Payments');
    },
    continueToPayment(){
      //alert(1);
      //this.$refs['checkoutRef'][0].redirectToCheckout();
    },

    sumField(key) {
          // sum data in give key (property)
          return this.selected.reduce((a, b) => parseInt(a) + parseInt((b[key] || 0)), 0)
      },

    setTitle(item) {
      this.tabTitle = item;
    },

    /*
                Includes Stripe.js dynamically
            */
            includeStripe( URL, callback ){
                let documentTag = document, tag = 'script',
                    object = documentTag.createElement(tag),
                    scriptTag = documentTag.getElementsByTagName(tag)[0];
                object.src = '//' + URL;
                if (callback) { object.addEventListener('load', function (e) { callback(null, e); }, false); }
                scriptTag.parentNode.insertBefore(object, scriptTag);
            },
    
            /*
                Configures Stripe by setting up the elements and 
                creating the card element.
            */
            configureStripe(){
                this.stripe = Stripe( this.stripeAPIToken );
    
                this.elements = this.stripe.elements();
                this.card = this.elements.create('card');
    
                this.card.mount('#card-element');
            },
  },
};
</script>
<style>
.inertia-link {
  text-decoration: none !important;
}
</style>


