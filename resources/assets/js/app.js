window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

window.Vue = require('vue');

import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
    load: {
        key: ""
    }
});

const app = new Vue({
    data() {
        return {
            search: '',
            city: ''
        }
    },
    created() {

    },
    methods: {

    }
}).$mount('#app');