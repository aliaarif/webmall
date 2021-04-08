<template>
  <!-- App.vue -->

  <v-app>
    <v-navigation-drawer
      app
      v-if="auth && auth.roles[0].name === 'Admin' && drawer"
      class="primary"
      dark
      permanent
    >
      <v-list>
        <v-list-item>
          <v-list-item-avatar>
            <!-- <img :src="auth.avatar" :alt="auth.name" /> -->
            <v-img :src="auth.avatar" :alt="auth.name"></v-img>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ auth.name }}</v-list-item-title>
            <v-list-item-subtitle>{{
              auth.roles[0].name
            }}</v-list-item-subtitle>
          </v-list-item-content>

          <!-- <v-list-item-action>
            <v-btn :class="fav ? 'red--text' : ''" icon @click="fav = !fav">
              <v-icon>mdi-heart</v-icon>
            </v-btn>
          </v-list-item-action> -->
        </v-list-item>
      </v-list>

      <v-divider></v-divider>

      <v-list>
        <v-list-item
          v-for="(module, index) in modules"
          :key="index"
          link
          dark
          @click="drawer = !drawer"
        >
          <v-list-item-content>
            <v-list-item-title color="primary">
              <v-icon>mdi-view-module</v-icon>
              {{ module.menu }}</v-list-item-title
            >
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn color="primary" block @click="logout">
            <i class="material-icons"> logout </i> Logout
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar dense app>
      <v-app-bar-nav-icon
        v-if="auth && auth.roles[0].name === 'Admin'"
        @click="drawer = !drawer"
      ></v-app-bar-nav-icon>
      <v-tabs>
        <v-tab class="inertia-link" link>
          <inertia-link href="/" class="inertia-link">
            WEBMALL
          </inertia-link>
        </v-tab>
        <v-spacer></v-spacer>
     <v-tab class="inertia-link" link v-if="cartItems > 0">
      <inertia-link href="/cart" class="inertia-link">
        <v-badge
          color="primary"
          :content="cartItems"
          class="mt-4"
        >
        <v-icon color="primary">mdi-cart</v-icon>
        </v-badge>
        </inertia-link>
        </v-tab>

        <v-tab v-if="auth" class="mr-n1">
          <v-menu
            class="custom-nmr"
            v-for="([text, rounded], index) in btns"
            :key="text"
            :rounded="rounded"
            open-on-hover
            bottom
            offset-y
          >
            <template v-slot:activator="{ attrs, on }">
              <v-btn
                :color="colors[index]"
                class="white--text ma-0"
                v-bind="attrs"
                v-on="on"
              >
                <v-list-item-avatar>
                    <v-img :src="auth.avatar" :alt="auth.name"></v-img>
                </v-list-item-avatar>
               &nbsp; {{ auth.name }} &nbsp;
              </v-btn>
            </template>

            <v-list>
              <v-list-item link block>
                <inertia-link href="/dashboard" class="inertia-link">
                  <i class="material-icons mr-1"> dashboard </i>
                  DASHBOARD
                </inertia-link>
              </v-list-item>

              <v-spacer></v-spacer>

              <v-list-item link @click="logout">
                <v-btn color="primary" block @click="logout">
                  <i class="material-icons"> logout </i> LOGOUT
                </v-btn>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-tab>
        <v-tab class="inertia-link" link v-else>
          <inertia-link href="login" class="inertia-link">
            <i class="material-icons"> login </i></inertia-link
          >
        </v-tab>
      </v-tabs>
    </v-app-bar>
    <v-main>
      <v-container fluid>
        <slot />
      </v-container>
    </v-main>
    <v-footer app></v-footer>
  </v-app>
</template>
<style scoped>
.inertia-link {
  height: 50p x;
  text-decoration: none !important;
}
.v-list-item__title {
  font-size: 0.8rem !important;
}
.v-list-item {
  padding: 0 10px !important;
  font-weight: bold !important;
}
.v-btn:not(.v-btn--round).v-size--default {
  height: 50px;
  min-width: 100px;
  padding: 0 16px;
}
</style>
<script>
export default {
  props: ["meta", "auth", "modules", "cartItems"],
  data: () => ({
    drawer: false,
    btns: [["Removed", "0"]],
    colors: ["primary"],
    items: [...Array(4)].map((_, i) => `Item ${i}`),
  }),
  methods: {
    logout() {
      let loggedOut = this.$inertia.post("logout") ? true : false;
      loggedOut ? localStorage.removeItem("auth") : "";
    },
  },
  watch: {
    meta: {
      immediate: true,
      handler(meta) {
        document.title = meta.title;
        // $("head").append(
        //   "<meta name='description' content='" + meta.description + "'/>"
        // );
      },
    },
  },
};
</script>
