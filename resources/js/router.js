import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store'

import Welcome from './pages/Welcome';
import Login from './pages/Login';
import Register from './pages/Register';
import Forgot from './pages/Forgot';
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

const ifNotAuthenticated = async (to, from,next) => {
    if(store.getters['auth/authenticated']){
    return next({
      name: 'beranda'
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
      meta: {layout: 'default'}
    },
    {
      name: 'login',
      path: '/login',
      component: Login,
      meta: {layout: 'default'},
      
    },
    {
      name: 'register',
      path: '/register',
      component: Register,
      meta: {layout: 'default'}
    },
    {
      name: 'forgot',
      path: '/forgot',
      component: Forgot,
      meta: {layout: 'default'}
    },
    {
      name: 'beranda',
      path: '/beranda',
      component: Beranda,
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'message',
      path:'/message',
      component: Message,
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'post',
      path: '/post',
      component: Post,
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'search',
      path: '/search',
      component: Search,
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
    {
      name: 'profile',
      path: '/profile/:username',
      component: Profile,
      meta: {layout: "home"},
      beforeEnter: ifAuthenticated
    },
  ]
});


export default router;