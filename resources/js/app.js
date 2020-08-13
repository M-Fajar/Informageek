require('./bootstrap');

window.Vue = require('vue');

import router from './router';

import App from './pages/App.vue';

import Default from './layout/Default.vue';
import Home from './layout/Home.vue';

vue.components('default-layout', Default);
vue.components('home-layout', Home)

new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
