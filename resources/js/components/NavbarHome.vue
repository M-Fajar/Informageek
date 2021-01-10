<template>

    <nav  class="navbar sticky-top navbar-expand-lg navbar-light bg-white border-bottom">
        <router-link class="navbar-brand pl-2" :to="{name: 'beranda'}">
            <i class="fas fa-circle text-warning fa-2x"></i>
        </router-link>
         
        <h2 class="pl-3"  >   <router-link style="color:black"  :to="{name: 'beranda'}">  Informageek </router-link></h2>
         
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <div class="form-inline ml-auto px-0 mr-0">
                <form @keyup="redirectSearch">
                    <input v-model="find" class="form-control form-control-lg" type="search" placeholder="Cari">
                </form>
            </div>
            <ul class="navbar-nav ml-auto align-items-center">
    
                <li class="nav-item">   
                     <router-link class="nav-link" :to="{name: 'profile',params: {username:user.username}}">
                        
                        <!-- <a class="nav-link" :href="$router.resolve({name: 'profile',params: {username:user.username}}).href"> -->

                        <b> {{user.username}}</b>
                        <img v-bind:src="'/media/avatar/'+ user.foto" id="avatar" alt="avatar" class="img-fluid">
                    <!-- </a> -->
                     </router-link>
                    
                    
                </li>    
    
               
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'message'}">
                        <i class="far fa-envelope fa-2x">
                            <v-badge v-if="countMessage > 0"
                            color="red"
                            :content="countMessage"
                            >
                            </v-badge>
                        </i>
                        
                    </router-link>
                </li>
                <!-- <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'profile',params: {username:user.username}}">
                        <i class="far fa-bell fa-2x "></i>
                    </router-link>
                </li> -->
                <li class="nav-item dropdown" style="float:right;">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <!-- <i class="fas fa-cog fa-2x"></i> -->
                        <span class="fa-stack">
                            <i class="fas fa-circle fa-stack-2x text-warning"></i>
                            <i class="fas fa-cog fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" @click.prevent="logOut">Keluar</a>
                    </div>
                </li>
            </ul>

        </div>
    </nav>

</template>

<style scoped>
    .navbar .collapse input{
        width: 700px;
        background: #F9F8F8;
        border-radius: 45px;
        text-decoration-style: none;
    }
    #avatar{    
    width: 2.5rem;
    margin-left: 7px;
    object-fit: cover;
    height: 2.5rem;
    border-radius: 5vw;
}
.dropdown-menu{
    margin-top:18px ;
}
</style>

<script>
import { mapGetters,mapActions } from "vuex"
import axios from 'axios'
import router from '../router'
export default {
    components:{
        
    },
    data(){
        return{
            find:'',
            countMessage:null
        }
    },
    props:{
        user:{
            default: null
        }
    },
    methods: {
        redirectSearch() {
            this.$router.push('/search/'+this.find);
        },
        ...mapActions({
            logOutAction: 'auth/logOut'
        }),
        logOut(){
            this.logOutAction().then(() => {
                this.$router.replace({
                    name: 'welcome'
                })
            })
        },
        hanleIncoming(message){
            if(this.countMessage != null){
                this.countMessage +=1
                }
            
            
            },
       
    },
    
   watch:{
    $route(to, from) {
        if(to.name != "search"){
            this.find = ''
        }
        if(to.name == "message"){
            this.countMessage = null
        }
         if(from.name == "message"){
            
             axios.get('auth/message/unread',{
                headers: {
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                },
                 }).then(response =>{
                 this.countMessage = response.data
                })
        }
    },
    
   },
   mounted(){
        axios.get('auth/message/unread',{
                headers: {
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                },
        }).then(response =>{
            this.countMessage = response.data
        })

         Echo.private(`messages.${this.user.uid}`)
                .listen('NewMessage', (e) => {
                     this.hanleIncoming(e.message);
                });
       
   }
    
}


</script>