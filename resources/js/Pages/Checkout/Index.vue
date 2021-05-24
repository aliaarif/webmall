<template>
  <layout :meta="meta" :auth="auth" :cartItems="cartTotalQuantity">
    <v-row justify="center" class="mt-1">
      <v-dialog v-model="dialog" persistent max-width="600px">
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            id="addAddressModal"
            class="d-none"
            v-bind="attrs"
            v-on="on"
          ></v-btn>
        </template>
        <v-card>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-card-title>
              <span class="headline">Add New Address</span>
            </v-card-title>
            <v-card-text>
              <v-row>
                <v-col cols="12" sm="4">
                  <v-select
                    label="Address Type*"
                    hint="Please select a address type"
                    v-model="addressType"
                    :items="['Home', 'Office']"
                    :rules="[(v) => !!v || 'Required!']"
                    required
                  ></v-select>
                </v-col>
                <v-col cols="12" sm="8">
                  <v-text-field
                    label="Name*"
                    hint="Person name who recieving the package"
                    v-model="personName"
                    :rules="personNameRules"
                    :counter="20"
                    :value="auth.name"
                    required
                  ></v-text-field>
                </v-col>
                <!-- <v-col cols="12" sm="6">
                  <v-autocomplete
                    label="Country"
                    hint="Please select a country"
                    v-model="countrySelect"
                    :loading="countryModalLoading"
                    :items="countries"
                    :rules="[(v) => !!v || 'Country name is required']"
                    :search-input.sync="countrySearch"
                    required
                    cache-items
                    flat
                    hide-no-data
                    @click="getStates(items.id)"
                  ></v-autocomplete>
                </v-col>

                <v-col cols="12" sm="6">
                  <v-autocomplete
                    label="State"
                    hint="Please select a state"
                    v-model="stateSelect"
                    :loading="stateModalLoading"
                    :items="states"
                    :rules="[(v) => !!v || 'State name is required']"
                    :search-input.sync="stateSearch"
                    required
                    cache-items
                    flat
                    hide-no-data
                  ></v-autocomplete>
                </v-col>

                <v-col cols="12" sm="5">
                  <v-autocomplete
                    v-model="citySelect"
                    :loading="cityModalLoading"
                    :items="cities"
                    :search-input.sync="citySearch"
                    cache-items
                    flat
                    hide-no-data
                    label="City"
                  ></v-autocomplete>
                </v-col>

                <v-col cols="12" sm="4">
                  <v-text-field
                    v-model="pin"
                    label="PIN*"
                    type="text"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="3">
                  <v-text-field
                    v-model="flatNo"
                    label="Flat No*"
                    type="text"
                    required
                  ></v-text-field>
                </v-col> -->
              </v-row>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">
                Close
              </v-btn>
              <v-btn
                :disabled="!valid"
                color="blue darken-1"
                text
                @click="saveAddress()"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </v-row>

    <v-card>
      <v-toolbar flat color="primary" dark>
        <v-toolbar-title>Cart and shipping details</v-toolbar-title>
        <v-spacer></v-spacer>

        <v-btn color="success" right @click="makePayment()">
          Place Your Order
        </v-btn>
      </v-toolbar>
      <v-tabs vertical>
        <v-tab>
          <v-icon left> mdi-cart </v-icon>
          Cart Items
        </v-tab>

        <v-tab>
          <v-icon left> mdi-map </v-icon>
          &nbsp;&nbsp;Address&nbsp;&nbsp;
        </v-tab>

        <v-tab>
          <v-icon left> mdi-cards </v-icon>
          Your Cards
        </v-tab>

        <v-tab-item>
          <v-card flat>
            <v-card-text>
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">Name</th>
                      <th class="text-left">Price</th>
                      <th class="text-left">Quantity</th>
                      <th class="text-left">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in cartItems" :key="product.id">
                      <td>
                        <v-avatar class="mr-1">
                          <span>
                            <v-img
                              :src="product.attributes['cover_img']"
                              width="150"
                            />
                          </span>
                        </v-avatar>
                        {{ product.name }}
                      </td>
                      <td>{{ product.price }}</td>
                      <td>{{ product.quantity }}</td>
                      <td>{{ product.price * product.quantity }}</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-card-text>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <v-card-text class="pa-2" elevation="2" outlined shaped>
              <p class="text-h6">
                Select a shipping address
                <v-icon
                  aria-hidden="false"
                  @click="openAddressModal()"
                  color="primary"
                  class="ml-2"
                  >mdi-plus</v-icon
                >
              </p>
              <v-list two-line>
                <v-list-item-group
                  v-model="selectedAddress"
                  active-class="primary--text"
                >
                  <template v-for="(address, index) in addresses">
                    <v-list-item :key="address.id">
                      <template v-slot:default="{ active }">
                        <v-list-item-content>
                          <v-list-item-title
                            v-text="address.person_name"
                          ></v-list-item-title>
                          <v-list-item-subtitle
                            v-text="address.subtitle"
                          ></v-list-item-subtitle>
                        </v-list-item-content>
                        <v-list-item-action>
                          <v-list-item-action-text>
                            <v-icon v-if="active" color="primary lighten-4">
                              checked
                            </v-icon>
                          </v-list-item-action-text>
                        </v-list-item-action>
                      </template>
                    </v-list-item>
                    <v-divider
                      v-if="index < addresses.length - 1"
                      :key="index"
                    ></v-divider>
                  </template>
                </v-list-item-group>
              </v-list>
            </v-card-text>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <v-card-text class="pa-2" elevation="2" outlined shaped>
              <p class="text-h6">
                Select a card
                <v-icon
                  aria-hidden="false"
                  @click="addCard()"
                  color="primary"
                  class="ml-2"
                  >mdi-plus</v-icon
                >
              </p>
              <v-list two-line>
                <v-list-item-group
                  v-model="selectedCard"
                  active-class="primary--text"
                >
                  <template v-for="(card, index) in cards">
                    <v-list-item :key="card.id">
                      <template v-slot:default="{ active }">
                        <v-list-item-content>
                          <v-list-item-title
                            v-text="card.person_name"
                          ></v-list-item-title>
                          <v-list-item-subtitle
                            v-text="card.number"
                          ></v-list-item-subtitle>
                        </v-list-item-content>
                        <v-list-item-action>
                          <v-list-item-action-text>
                            <v-icon v-if="active" color="primary lighten-4">
                              checked
                            </v-icon>
                          </v-list-item-action-text>
                        </v-list-item-action>
                      </template>
                    </v-list-item>
                    <v-divider
                      v-if="index < cards.length - 1"
                      :key="index"
                    ></v-divider>
                  </template>
                </v-list-item-group>
              </v-list>
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </layout>
</template>

<script>
</script>

<script>
//import postscribe from 'postscribe'
import Layout from "../../Shared/Layout";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: [
    "meta",
    "auth",
    "cartItems",
    "cartTotalQuantity",
    "countries",
    "addresses",
  ],
  components: {
    Layout,
  },
  data: () => ({
    valid: true,
    addressType: null,
    personName: "",
    personNameRules: [
      (v) => !!v || "Person name is required",
      (v) =>
        (v && v.length <= 20) || "Person Name must be less than 20 characters",
    ],
    // countrySelect: null,
    // stateSelect: null,
    // citySelect: null,
    // pin: null,
    // flatNo: null,

    // countryModalLoading: false,
    // stateModalLoading: false,
    // cityModalLoading: false,

    // countrySearch: null,
    // stateSearch: null,
    // citySearch: null,

    // states: [],
    // cities: [],

    dialog: false,
    selectedAddress: true,
    selectedCard: true,

    cards: [
      {
        person_name: "Ali Connors",
        headline: "Brunch this weekend?",
      },
      {
        person_name: "me, Scrott, Jennifer",
        headline: "Summer BBQ",
      },
      {
        person_name: "Sandra Adams",
        headline: "Oui oui",
      },
    ],
  }),

  created() {},
  mounted() {
    //alert(1);
  },
  watch: {
    search(val) {
      val && val !== this.select && this.querySelections(val);
    },
  },
  methods: {
    removeFromCart(productId) {
      var data = { productId: productId };
      Inertia.post("/remove-from-cart", data, {
        onSuccess: (res) => {},
        onError: (errors) => {},
      });
    },
    increment(pid) {
      var pid = pid;
      var qty = $("#productQty-" + pid).val();
      var data = { pid: pid, qty: qty, action: "plus" };
      Inertia.post("/update-cart", data, {
        onSuccess: (res) => {},
        onError: (errors) => {},
      });
    },
    decrement(pid) {
      var pid = pid;
      var qty = $("#productQty-" + pid).val();
      var data = { pid: pid, qty: qty, action: "minus" };
      console.log(data);
      Inertia.post("/update-cart", data, {
        onSuccess: (res) => {},
        onError: (errors) => {},
      });
    },
    openAddressModal() {
      $("#addAddressModal").trigger("click");
    },
    getStates(countryId) {
      alert(countryId);
    },
    saveAddress() {
      this.$refs.form.validate();

      let validate = this.addressType !== "" && this.personName !== "";
      // this.countrySelect !== "" &&
      // this.stateSelect !== "" &&
      // this.citySelect !== "" &&
      // this.pin !== "" &&
      // this.flatNo
      //   ? true
      //   : false;
      if (validate) {
        var data = {
          addressType: this.addressType,
          personName: this.personName,
          //countrySelect: this.countrySelect,
          // stateSelect: this.stateSelect,
          // citySelect: this.citySelect,
          // pin: this.pin,
          // flatNo: this.flatNo,
        };
        Inertia.post("/save-address", data, {
          onSuccess: () => {
            // Handle success event
          },
          onError: (errors) => {
            // Handle validation errors
            //console.log(errors);
          },
        });
      } else {
        this.error = true;
      }
    },
    querySelections(v) {
      this.loading = true;
      // Simulated ajax query
      setTimeout(() => {
        this.items = this.states.filter((e) => {
          return (e || "").toLowerCase().indexOf((v || "").toLowerCase()) > -1;
        });
        this.loading = false;
      }, 500);
    },

    makePayment() {
      // var options = {
      //   key: "YOUR_KEY_ID", // Enter the Key ID generated from the Dashboard
      //   amount: "50000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
      //   currency: "INR",
      //   name: "Acme Corp",
      //   description: "Test Transaction",
      //   image: "https://example.com/your_logo",
      //   order_id: "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
      //   handler: function (response) {
      //     alert(response.razorpay_payment_id);
      //     alert(response.razorpay_order_id);
      //     alert(response.razorpay_signature);
      //   },
      //   prefill: {
      //     name: "Gaurav Kumar",
      //     email: "gaurav.kumar@example.com",
      //     contact: "9999999999",
      //   },
      //   notes: {
      //     address: "Razorpay Corporate Office",
      //   },
      //   theme: {
      //     color: "#3399cc",
      //   },
      // };

      //var rzp1 = new Razorpay(options);
      // rzp1.on("payment.failed", function (response) {
      //   alert(response.error.code);
      //   alert(response.error.description);
      //   alert(response.error.source);
      //   alert(response.error.step);
      //   alert(response.error.reason);
      //   alert(response.error.metadata.order_id);
      //   alert(response.error.metadata.payment_id);
      // });

      // alert(1);
      // rzp1.open();
      // e.preventDefault();

      //alert(1);
      var data = {
        addressType: this.addressType,
        personName: this.personName,
        countrySelect: this.countrySelect,
        stateSelect: this.stateSelect,
        citySelect: this.citySelect,
        pin: this.pin,
        flatNo: this.flatNo,
      };
      Inertia.post("/make-payment", data, {
        onSuccess: () => {
          this.responseStatus === false
            ? (this.error = true)
            : this.responseStatus;
        },
        onError: (errors) => {
          // Handle validation errors
          //console.log(errors);
        },
      });
    },
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
