require('./bootstrap');


window.Vue = require('vue');
import store from "./store/index"
import router from './router';


import App from './App.vue';
import axios from 'axios';
import Default from './layouts/Default.vue';
import Home from './layouts/Home.vue';

axios.defaults.baseURL = 'http://127.0.0.1:8000/api'


Vue.component('default-layout', Default);
Vue.component('home-layout', Home)



Vue.config.productionTip = false

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('message', require('./components/backend/MessageComponent.vue').default);
Vue.component('chat', require('./components/backend/ChatComponent.vue').default);
Vue.component('room', require('./components/backend/RoomComponent.vue').default);


new Vue({
    store,
    router,
    el: '#app',
    render: h => h(App)
});
