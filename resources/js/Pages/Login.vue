<template>
  <layout :meta="meta" :auth="auth" :modules="modules">
    <v-card flat>
      <v-toolbar color="#68246D" dark>
        <v-toolbar-title>Login with {{ tabTitle }} </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-title>Login Panel</v-toolbar-title>
        <template v-slot:extension>
          <v-tabs v-model="currentItem" centered slider-color="white">
            <v-tab
              v-for="(item, index) in guestTabs"
              :key="index"
              :href="'#tab-' + item"
              class="inertia-link"
              @click="setTitle(item)"
            >
              {{ item }}
            </v-tab>
          </v-tabs>
        </template>
      </v-toolbar>
      <v-tabs-items v-model="currentItem">
        <v-tab-item
          v-for="item in guestTabs"
          :key="item"
          :value="'tab-' + item"
        >
          <v-row no-gutters>
            <v-col md="4" offset-md="4">
              <v-card elevation="12" class="pa-2 mt-12 mb-12" outlined tile>
                <v-card-text>
                  <h4>Login to Application</h4>
                  <p align="hustify">
                    <strong>Login with {{ tabTitle }}.</strong>
                  </p>
                  <v-card flat class="mx-auto" v-if="tabTitle === 'Username'">
                    <v-alert
                      class="mr-2"
                      dense
                      outlined
                      type="error"
                      v-if="error"
                    >
                      Wrong credentials!
                    </v-alert>

                    <form autocomplete="off">
                      <v-text-field
                        v-model="username"
                        label="Username/Email/Mobile/Banner ID/Student ID"
                        hint="Please provide your username or email or mobile or bannerID or studentID"
                        required
                      ></v-text-field>

                      <v-text-field
                        v-model="password"
                        type="password"
                        label="Password"
                        hint="Please provide your password"
                        required
                      ></v-text-field>
                      <v-btn color="primary" class="mr-4 mt-4" @click="login">
                        Login
                      </v-btn>
                      <!-- <v-btn @click="clear" class="mt-4"> clear </v-btn> -->
                    </form>
                  </v-card>

                  <v-card
                    flat
                    class="mx-auto mb-12"
                    v-if="tabTitle === 'Social'"
                  >
                    <v-row align="center" justify="space-around">
                      <v-btn
                        class="mt-12 text-h6"
                        color="error"
                        dark
                        @click="signInWithSocial('google')"
                      >
                        <span class="mdi mdi-google"></span>
                        OOGLE
                      </v-btn>

                      <v-btn
                        class="mt-12"
                        color="#4267B2"
                        dark
                        @click="signInWithSocial('facebook')"
                      >
                        <span class="mdi mdi-facebook mr-1"></span>
                        Facebook1
                      </v-btn>

                      <v-btn
                        class="mt-12"
                        color="dark"
                        dark
                        @click="signInWithSocial('github')"
                      >
                        <span class="mdi mdi-github mr-1"></span>
                        GitHub
                      </v-btn>
                    </v-row>

                    <v-row align="center" justify="space-around">
                      <v-btn
                        class="mt-12"
                        color="light-blue"
                        dark
                        @click="signInWithSocial('twitter')"
                      >
                        Twitter
                      </v-btn>
                      <v-btn
                        class="mt-12"
                        color="blue"
                        dark
                        @click="signInWithSocial('linkedIn')"
                      >
                        LinkedIn
                      </v-btn>

                      <v-btn
                        class="mt-12"
                        color="blue"
                        dark
                        @click="signInWithSocial('bitbucket')"
                      >
                        Bitbucket
                      </v-btn>

                      <v-btn
                        class="mt-12"
                        color="blue"
                        dark
                        @click="signInWithSocial('gitLab')"
                      >
                        GitLab
                      </v-btn>
                    </v-row>
                  </v-card>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
  </layout>
</template>
<script>
import Layout from "../Shared/Layout";
import { Inertia } from "@inertiajs/inertia";
export default {
  props: ["meta", "auth", "modules", "tab", "responseStatus"],
  components: {
    Layout,
  },
  data: () => ({
    username: "",
    password: "",
    error: false,
    tabTitle: "Username",
    currentItem: "tab-Username",
    guestTabs: ["Username", "Social"],
  }),
  created() {
    if (this.auth) {
      window.location.href = "/dashboard";
    }
  },

  methods: {
    signInWithSocial(social) {
      window.location.href = "http://application/sign-in/" + social;
    },
    login() {
      let validate =
        this.username !== "" && this.password !== "" ? true : false;
      if (validate) {
        var data = {
          username: this.username,
          password: this.password,
        };
        Inertia.post("/login", data, {
          onSuccess: () => {
            // Handle success event
            this.responseStatus === false
              ? (this.error = true)
              : this.responseStatus;
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
    setTitle(item) {
      this.tabTitle = item;
    },
  },
};
</script>
<style>
.inertia-link {
  text-decoration: none !important;
}
</style>


