
import axios from 'axios'
import Vue from 'vue'
import auth from './auth'

import { attempt } from 'lodash'

export default { 
    namespaced : true,
	state: {
        token: null,
        user: null
    },

    getters: {
        authenticated(state){
            return state.token && state.user 
        },
        user (state){
         return state.user
        }
    },

    mutations: {
        SET_TOKEN(state,token){
            state.token = token
        },
        SET_USER(state,data){
            state.user = data
        }
    },

	actions: {
        async logIn({ dispatch },credentials){
            let response = await axios.post('auth/login',credentials)
            return dispatch('attempt',response.data.token)
         },
         
        async attempt ({ commit,state,dispatch },token){
            if(token){

                commit('SET_TOKEN',token)
                localStorage.setItem('user-token',token)    
            }
            
            if(!state.token){
                return dispatch('logOut')
            }

            try{
                let response = await axios.get('auth/profile',{
                    headers:{
                        'Authorization' : 'Bearer '+ token
                    }
                })
                if(response.data.error == "Unauthorized"){
                    return dispatch('logOut')
                } else {
                    
                    commit('SET_USER',response.data)    
                    localStorage.setItem('user-token',token)    
                }
                
            } catch (err){
                commit('SET_TOKEN',null)   
                commit('SET_USER',null)
                localStorage.removeItem('user-token')
            }
        },
        async logOut({commit}){
            return axios.post('auth/logout').then(() => {
                commit('SET_TOKEN',null)   
                commit('SET_USER',null)
                localStorage.removeItem('user-token')
                delete axios.defaults.headers.common['Authorization']
            })
        }
    }

	
      
}