<template>
<v-app>
    <div>
        
        
        <NavbarHome v-if="auth == true || user!=null" :user="user"/>
        <NavbarLogin v-if="auth == false && user==null"/>
        
      
        <slot/>
        
    </div>
    </v-app>
</template>

<script>
import NavbarHome from '../components/NavbarHome'
import { mapGetters,mapActions } from "vuex"
import NavbarLogin from "../components/NavbarLogin"
export default {
    components: {
        NavbarHome,
        NavbarLogin
    }
    ,data(){
        return{
            auth: null
        }
    }
    , 
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),

    
    },
    mounted :function(){
        
            
            setTimeout(() => (  this.user == null? this.auth = false:  this.auth =  true), 900)
            console.log(this.user)
            
        
    }
    
}
</script>