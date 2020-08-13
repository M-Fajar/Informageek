<template>
    <div class="container d-flex flex-column justify-content-between vh-100">
        <NavbarLogin/>

        <slot/>
        
        <FooterLogin/>
    </div>
</template>

<script>
import NavbarLogin from '../components/NavbarLogin';
import FooterLogin from '../components/FooterLogin';

export default {
    components: {
        NavbarLogin,
        FooterLogin
    }
}
</script>