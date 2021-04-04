<template>
  <layout :meta="meta" :auth="auth" :modules="modules">
    <v-card>
      <v-toolbar color="deep-purple accent-4" dark>
        <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
        <v-toolbar-title>{{ tabTitle }} </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-title>Business School Application Fee</v-toolbar-title>
        <template v-slot:extension centered>
          <v-tabs v-model="currentItem" slider-color="white">
            <v-tab
              v-for="item in items"
              :key="item"
              :href="'#tab-' + item"
              class="inertia-link"
              @click="setTitle(item)"
            >
              {{ item }}
            </v-tab>

            <v-menu v-if="more.length" bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  text
                  class="align-self-center mr-4"
                  v-bind="attrs"
                  v-on="on"
                >
                  more
                  <v-icon right> mdi-menu-down </v-icon>
                </v-btn>
              </template>

              <v-list class="grey lighten-3">
                <v-list-item
                  v-for="item in more"
                  :key="item"
                  @click="addItem(item)"
                >
                  {{ item }}
                </v-list-item>
              </v-list>
            </v-menu>
          </v-tabs>
        </template>
      </v-toolbar>

      <v-tabs-items v-model="currentItem">
        <v-tab-item
          v-for="item in items.concat(more)"
          :key="item"
          :value="'tab-' + item"
        >
          <v-card flat>
            <v-card-text v-if="item == 'Login Panel'">
              <h4>Online Application Fee Payments</h4>
              <p align="hustify">
                <strong
                  >This web page can only be used to pay an application fee to
                  Durham University.</strong
                >
              </p>
              <p align="hustify">
                To pay your application fee, we will need you to provide your
                Banner ID number and either the email address, which you have
                already provided to the University or your date of birth.
              </p>

              <form @submit.prevent="submit">
                <v-text-field
                  col="6"
                  v-model="bannerID"
                  :counter="10"
                  :error-messages="errors"
                  label="Banner ID"
                  hint="Your Banner ID number is the last nine digits of your Application Reference, which you can find listed by your application in your Applicant Portal"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="phoneNumber"
                  :counter="7"
                  :error-messages="errors"
                  label="Phone Number"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="email"
                  :error-messages="errors"
                  label="E-mail"
                  required
                ></v-text-field>

                <v-select
                  v-model="select"
                  :items="items"
                  :error-messages="errors"
                  label="Select"
                  data-vv-name="select"
                  required
                ></v-select>

                <v-checkbox
                  v-model="checkbox"
                  :error-messages="errors"
                  value="1"
                  label="Option"
                  type="checkbox"
                  required
                ></v-checkbox>

                <v-btn class="mr-4" type="submit" :disabled="invalid">
                  submit
                </v-btn>
                <v-btn @click="clear"> clear </v-btn>
              </form>

              <p align="hustify">
                Please check your information for errors and try again. If you
                continue to experience problems, please contact us using the
                Comments and Questions.
              </p>
            </v-card-text>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
  </layout>
</template>
<script>
import Layout from "../Shared/Layout";
export default {
  props: ["meta", "auth", "modules", "tab"],
  components: {
    Layout,
  },
  data: () => ({
    tabTitle: "Login Panel",
    currentItem: "tab-Login Panel",
    items: [
      "Login Panel",
      "Confirm Personal Data",
      "Select Applications",
      "Make Payments",
    ],
    more: ["Extra Step 1", "Extra Step 2", "Extra Step 3"],
    //text: 'Thank you for agreeing to make an online application fee payment to Durham University. Please follow these simple steps to process.',
    bannerID: "",
    phoneNumber: "",
    email: "",
    select: null,
    items1: ["Item 1", "Item 2", "Item 3", "Item 4"],
    checkbox: null,
  }),

  methods: {
    submit() {
      let validation = this.$refs["observer"][0].validate();
      //let respone = validation ? await this.$inertia.post()
    },
    clear() {
      this.bannerID = "";
      this.phoneNumber = "";
      this.email = "";
      this.select = null;
      this.checkbox = null;
      this.$refs.observer.reset();
    },
    setTitle(item) {
      this.tabTitle = item;
    },
    addItem(item) {
      const removed = this.items.splice(0, 1);
      this.items.push(...this.more.splice(this.more.indexOf(item), 1));
      this.more.push(...removed);
      this.$nextTick(() => {
        this.currentItem = "tab-" + item;
        this.setTitle(item);
      });
    },
  },
};
</script>
<style>
.inertia-link {
  text-decoration: none !important;
}
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>


