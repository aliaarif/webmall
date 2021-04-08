<template>
  <layout :meta="meta" :auth="auth" :modules="modules" :cartItems="cartItems">
    <div align="center" class="pa-1 d-flex justify-center text-h6">
      Hi, {{ auth.name }} - {{ auth.roles[0].name }}, Welcome to dashboard
    </div>
    <v-row class="mt-1">
      <v-col
        cols="12"
        xl="3"
        lg="3"
        md="4"
        sm="6"
        xs="12"
        v-for="(module, index) in modules"
        :key="index"
      >
        <v-hover v-slot="{ hover }" open-delay="0">
          <v-card
            :elevation="hover ? 16 : 1"
            :class="{ 'on-hover': hover }"
            class="mx-auto"
          >
            <v-img
              :aspect-ratio="16 / 9"
              src="https://cdn.vuetifyjs.com/images/cards/kitchen.png"
            >
              <v-expand-transition>
                <div
                  v-if="hover"
                  class="d-flex transition-fast-in-fast-out purple darken-1 v-card--reveal display-3 white--text"
                  style="height: 100%"
                >
                  <inertia-link
                    class="inertia-link white--text"
                    :href="module.route"
                  >
                    <v-btn color="white darken-4" text> View Details </v-btn>
                  </inertia-link>
                </div>
              </v-expand-transition>
            </v-img>
            <v-card-text class="pt-1" style="position: relative">
              <v-btn
                absolute
                color="purple"
                class="white--text"
                fab
                small
                right
                top
              >
                <v-icon>mdi-cart</v-icon>
              </v-btn>

              <v-btn color="primary" text> {{ module.menu }} </v-btn>
            </v-card-text>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
    <!-- </v-container> -->
  </layout>
</template>
<script>
import Layout from "../Shared/Layout";
export default {
  props: ["meta", "auth", "modules", "catItems"],
  components: {
    Layout,
  },
  data: () => ({
    colors: [
      "deep-purple accent-4",
      "deep-purple accent-4",
      "deep-purple accent-4",
      "deep-purple accent-4",
      "deep-purple accent-4",
    ],
    slides: ["First", "Second", "Third", "Fourth", "Fifth"],

    currentItem: "tab-Web",
    items: [
      "PG Admissions Application Fee",
      "Business School Study Tours",
      "Campus Card Replacement",
      "Common Rooms",
      "Event Durham",
    ],
    more: [
      "Student Recruitment",
      "Direct Debits",
      "Languages For All",
      "Library Payments",
      "Print Credit Purchase",
      "Student Deposits",
      "Student Document Registry Shop",
    ],
    text:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
    show: false,
  }),

  created() {
    //  if (!this.auth) {
    //   window.location.href = "/login";
    // }
  },

  methods: {
    addItem(item) {
      const removed = this.items.splice(0, 1);
      this.items.push(...this.more.splice(this.more.indexOf(item), 1));
      this.more.push(...removed);
      this.$nextTick(() => {
        this.currentItem = "tab-" + item;
      });
    },
  },
};
</script>
<style>
/* Helper classes */
.basil {
  background-color: #fffbe6 !important;
}
.basil--text {
  color: #356859 !important;
}
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


