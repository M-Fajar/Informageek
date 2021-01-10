import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store'

import Welcome from './pages/Welcome';
import Login from './pages/Login';
import Register from './pages/Register';
import Forgot from './pages/Forgot';
import Hastag  from './pages/Hastag';
import Beranda from './pages/Beranda';
import Profile from './pages/Profile';
import Post from './pages/Post';
import Search from './pages/Search';
import auth from './store/auth';
import { isNull } from 'lodash';
import Message from './pages/Message';

Vue.use(VueRouter);


const ifAuthenticated = async (to, from,next) => {
  if(localStorage.getItem('user-token')){
    await store.dispatch('auth/attempt',localStorage.getItem('user-token'))
  }
  if(store.getters['auth/authenticated']){
    return next()
  }
    next({
      name: 'login'
    })
}
const guestAcces = async (to, from,next) => {
  if(localStorage.getItem('user-token')){
    await store.dispatch('auth/attempt',localStorage.getItem('user-token'))
  }
    
  return next()
  
}

const ifNotAuthenticated = async (to, from,next) => {
  if(localStorage.getItem('user-token')){
    await store.dispatch('auth/attempt',localStorage.getItem('user-token'))
  }
  if(store.getters['auth/authenticated']){
    return next({
      name:'beranda'
    })
  }
    next()
}

const router = new VueRouter({
  mode: 'history',
  'routes': [
    {
      name: 'welcome',
      path: '/',
      component: Welcome,
      meta: {layout: 'default'},
      beforeEnter: ifNotAuthenticated
    },
    {
      name: 'login',
      path: '/login',
      component: Login,
      meta: {layout: 'default'},
      beforeEnter: ifNotAuthenticated
      
    },
    {
      name: 'register',
      path: '/register',
      component: Register,
      meta: {layout: 'default'},
      beforeEnter: ifNotAuthenticated
      
    },
    {
      name: 'forgot',
      path: '/forgot',
      component: Forgot,
      meta: {layout: 'default'},
      beforeEnter: ifNotAuthenticated
    },
    {
      name: 'beranda',
      path: '/beranda',
      component: () => import('./pages/Beranda.vue'),
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'message',
      path:'/message/:userTo?',
      component: () =>import('./pages/Message.vue'),
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'post',
      path: '/post/:id',
      component: () =>import('./pages/Post.vue'),
      meta: {layout: "home"},
      beforeEnter: guestAcces    
    },
    {
      name: 'search',
      path: '/search/:key?',
      component:()=>import('./pages/Search.vue'),
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'profile',
      path: '/profile/:username',
      component: () => import('./pages/Profile.vue'),
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'hastag',
      path: '/hastag/:key?',
      component:()=>import('./pages/Hastag.vue'),
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
  ]

});


export default router;