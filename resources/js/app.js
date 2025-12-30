require('./bootstrap');

import Vue from 'vue';
import App from './components/App.vue';
import router from './router';
import registrationPlugin from './plugins/registrationPlugin';

// Install the registration plugin
Vue.use(registrationPlugin);

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

