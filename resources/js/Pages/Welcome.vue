<template>
  <layout :meta="meta" :auth="auth" :products="products" :cartItems="cartItems">
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
      Welcome to Webmall! A MultiSeller Ecommerce Platform 
    </div>
    <p align="center" class="pa-1 d-flex justify-center">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
      veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.
    </p>
    <v-row class="mt-1">
      <v-col
        cols="12"
        xl="3"
        lg="3"
        md="4"
        sm="6"
        xs="12"
        v-for="(product, index) in products"
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
              :src="product.cover_img"
            >
              <v-expand-transition>
                <div
                  v-if="hover"
                  class="d-flex transition-fast-in-fast-out purple darken-1 v-card--reveal display-3 white--text"
                  style="height: 100%"
                >
                  <inertia-link
                    class="inertia-link white--text"
                    :href="product.slug"
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
                @click="addToCart(product.id)"
              >
                <v-icon>mdi-cart</v-icon>
              </v-btn>
              <v-card-title>
                {{ product.name }}
              </v-card-title>

              <!-- <v-card-subtitle>
                {{ product.description }}
              </v-card-subtitle> -->

              <v-card-actions>
                <inertia-link class="inertia-link" :href="product.slug">
                  <v-btn color="primary" text> View Details </v-btn>
                </inertia-link>

                <v-spacer></v-spacer>

                <v-btn
                  color="deep-purple darken-4"
                  class="white--text"
                  fab
                  x-small
                  icon
                  @click="showMore(product.slug), (show = !show)"
                >
                  ...
                </v-btn>
              </v-card-actions>

              <v-expand-transition>
                <div v-if="show && showFor === product.slug">
                  <v-divider></v-divider>

                  <v-card-text>
                    {{ product.description }}
                  </v-card-text>
                </div>
              </v-expand-transition>
            </v-card-text>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </layout>
</template>
<script>
import Layout from "../Shared/Layout";
import { Inertia } from "@inertiajs/inertia";
export default {
  props: ["meta", "auth", "products", "cartItems"],
  components: {
    Layout,
  },
  data: () => ({
    colors: ["#68246D", "#68246D", "#68246D", "#68246D", "#68246D"],
    slides: ["First", "Second", "Third", "Fourth", "Fifth"],
    show: false,
    showFor: "",
  }),
  created() {},
  methods: {
    showMore(item) {
      this.showFor = item;
    },
    addToCart(pid){
      var data = { pid: pid};
       Inertia.post("/add-to-cart", data, {
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
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>


