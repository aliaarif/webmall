<template>
  <layout :meta="meta" :auth="auth" :modules="modules">
    <v-carousel
      cycle
      height="200"
      hide-delimiter-background
      show-arrows-on-hover
    >
      <v-carousel-item v-for="(slide, i) in slides" :key="i">
        <v-sheet :color="colors[i]" dark height="100%">
          <v-row class="fill-height" align="center" justify="center">
            <div class="display-3">{{ slide }} Slide</div>
          </v-row>
        </v-sheet>
      </v-carousel-item>
    </v-carousel>

    <div align="center" class="pa-1 d-flex justify-center text-h5">
      Welcome to Durham University’s Event Booking and Payment System
    </div>
    <p align="center" class="pa-1 d-flex justify-center">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.
    </p>

    <!-- <v-toolbar
      color="deep-purple accent-4"
    dark
    >
      <template v-slot:extension>
        <v-tabs
          v-model="currentItem"
          fixed-tabs
          slider-color="white"
        >
          <v-tab
            v-for="item in items"
            :key="item"
            :href="'#tab-' + item"
          >
            {{ item }}
          </v-tab>

          <v-menu
            v-if="more.length"
            bottom
            left
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                text
                class="align-self-center mr-4"
                v-bind="attrs"
                v-on="on"
              >
                more
                <v-icon right>
                  mdi-menu-down
                </v-icon>
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
    </v-toolbar> -->

    <!-- <v-container class="grey lighten-5"> -->
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
              <v-card-title>
                {{ module.menu }}
              </v-card-title>

              <v-card-subtitle>
                {{ module.desc }}
              </v-card-subtitle>

              <v-card-actions>
                <inertia-link class="inertia-link" :href="module.route">
                  <v-btn color="primary" text> View Details </v-btn>
                </inertia-link>

                <v-spacer></v-spacer>

                <v-btn
                  color="deep-purple darken-4"
                  class="white--text"
                  fab
                  x-small
                  icon
                  @click="showMore(module.title), (show = !show)"
                >
                  ...
                </v-btn>
              </v-card-actions>

              <v-expand-transition>
                <div v-if="show && showFor === module.title">
                  <v-divider></v-divider>

                  <v-card-text>
                    {{ module.desc }}
                  </v-card-text>
                </div>
              </v-expand-transition>
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
  props: ["meta", "auth", "modules"],
  components: {
    Layout,
  },
  data: () => ({
    colors: ["#68246D", "#68246D", "#68246D", "#68246D", "#68246D"],
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
    showFor: "",
  }),

  created() {
    //alert(this.auth);
  },

  methods: {
    showMore(item) {
      //this.show = !this.show;
      this.showFor = item;
    },
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


