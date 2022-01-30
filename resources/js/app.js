// require("./bootstrap");

import Vue from 'vue'
import VModal from 'vue-js-modal'

//Main pages
import App from './views/app.vue'

Vue.use(VModal);


const app = new Vue({
    el: '#app',
    VModal,
    components: { App }
});