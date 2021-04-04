require('./bootstrap');


import { App, plugin } from '@inertiajs/inertia-vue'
import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-load
import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'


import Vuetify from 'vuetify'
//import colors from 'vuetify/lib/util/colors'

import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)


Vue.config.productionTip = false
//Vue.config.devtools = true;

//window.__VUE_DEVTOOLS_GLOBAL_HOOK__.Vue = App.constructor;
//window.__VUE_DEVTOOLS_UID__.Vue = App.constructor;

Vue.use(plugin)

const el = document.getElementById('app')

new Vue({
    vuetify: new Vuetify({
        theme: {
            themes: {
                light: {
                    primary: '#68246D',
                    secondary: '#696969',
                    accent: '#8c9eff',
                    error: '#b71c1c',

                    //primary: colors.purple,
                    //secondary: colors.grey.darken1,
                    //accent: colors.shades.black,
                    //error: colors.red.accent3,
                    //background: colors.indigo.lighten5, // Not automatically applied

                },
                dark: {
                    //primary: colors.blue.lighten3,
                    //background: colors.indigo.base, // If not using lighten/darken, use base to return hex

                },
            },
        },
        icons: {
            iconfont: 'mdiSvg' || 'mdi' || 'md' || 'fa' || 'fa4' || 'faSvg'
        },
    }),
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(el)


