import auth from './auth'
import Vuex from 'vuex'
import Vue from 'vue'
import VueSession from 'vue-session'
Vue.use(VueSession)
Vue.use(Vuex)
import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
export default new Vuex.Store({
	state: {

	},

	actions: {
		
			
	},

	mutations: {
		
    },
    modules: {
		auth
		}
    
})













