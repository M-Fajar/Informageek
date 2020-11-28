require('./bootstrap');


window.Vue = require('vue');
import Vue from 'vue'
import store from "./store/index"
import router from './router';
import App from './App.vue';
import axios from 'axios';
import Default from './layouts/Default.vue';
import Home from './layouts/Home.vue';
import moment from 'moment'
import { result } from "lodash";

Vue.filter('formatDate', function(value) {
    if (value) {
        const now = moment();
        const created = moment(String(value));
        const diff = created.diff(now);
        //express as a duration
        const diffDuration = moment.duration(diff);
        // display
        let result = " ";
        if(diffDuration.years()<0){
            result = diffDuration.years()+' tahun yang lalu';
        }
        else if(diffDuration.months()<0){
            result = diffDuration.months()+' bulan yang lalu';
        }
        else if(diffDuration.days()<0){
            result = diffDuration.days() + ' hari yang lalu'
        } 
        else if(diffDuration.hours()<0){
            result = diffDuration.hours()+' jam yang lalu'
        }  
        else if(diffDuration.minutes()<0){
            result = diffDuration.minutes()+' menit yang lalu'
        }
        else if(diffDuration.seconds()<0){
            result = diffDuration.seconds()+' detik yang lalu'
        }
        else{
            result = ' Baru saja'
        }
        
      return result.substring(1);
    }
  });

  Vue.filter('dateComment', function(value) {
    if (value) {
        const now = moment();
        const created = moment(String(value));
        const diff = created.diff(now);
        //express as a duration
        const diffDuration = moment.duration(diff);
        // display
        let result = " ";
        if(diffDuration.years()<0){
            result = diffDuration.years()+' tahun';
        }
        else if(diffDuration.months()<0){
            result = diffDuration.months()+' bulan';
        }
        else if(diffDuration.days()<0){
            result = diffDuration.days() + ' hari'
        } 
        else if(diffDuration.hours()<0){
            result = diffDuration.hours()+' jam'
        }  
        else if(diffDuration.minutes()<0){
            result = diffDuration.minutes()+' menit'
        }
        else if(diffDuration.seconds()<0){
            result = diffDuration.seconds()+' detik'
        }
        else{
            result = ' Baru saja'
        }
        
      return result.substring(1);
    }
  });


axios.defaults.baseURL = 'http://127.0.0.1:8000/api'


Vue.component('default-layout', Default);
Vue.component('home-layout', Home)



Vue.config.productionTip = false



new Vue({
    store,
    router,
    el: '#app',
    render: h => h(App)
});
