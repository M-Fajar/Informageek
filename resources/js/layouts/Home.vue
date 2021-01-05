<template>
<v-app>
    <div>
        
        <div v-if="authenticated">
        <NavbarHome v-if="user!=null" :user="user"/>
        <NavbarLogin v-if="user == null"/>
        </div>
      
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
            
        }
    }
    , 
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),

    
    },
    watch:{
        
    }
}
</script>