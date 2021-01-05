<template>
<v-app>
    <div class="container d-flex flex-column justify-content-between vh-100">
        <NavbarLogin/>

        <slot/>
        
        <FooterLogin/>
        
    </div>
</v-app>
</template>

<script>
import NavbarLogin from '../components/NavbarLogin';
import FooterLogin from '../components/FooterLogin';

export default {
    components: {
        NavbarLogin,
        FooterLogin
    },
    methods:{
    
    }
    
}
</script>