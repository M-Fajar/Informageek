require('./bootstrap');

window.Vue = require('vue');

import router from './router';

import App from './App.vue';

import Default from './layouts/Default.vue';
import Home from './layouts/Home.vue';
import Messaging from './layouts/Messaging.vue';

Vue.component('default-layout', Default);
Vue.component('home-layout', Home)
Vue.component('messaging-layout', Messaging)

new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
