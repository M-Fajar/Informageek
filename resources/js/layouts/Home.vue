<template>
    <div>
        <NavbarHome/>
        <slot/>
    </div>
</template>

<script>
import NavbarHome from '../components/NavbarHome'

export default {
    components: {
        NavbarHome,
    }
}
</script>