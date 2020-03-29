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
            city: '',
            tags: []
        }
    },
    created() {

    },
    methods: {
        handleTag(tag) {
            console.log('handle tag');
            if(!this.tags.includes(tag)) {
                this.tags.push(tag);
            } else {
                this.tags.splice(this.tags.indexOf(tag), 1);
            }
        }
    }
}).$mount('#app');