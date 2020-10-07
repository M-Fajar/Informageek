<template>
    <div class="jumbotron jumbotron-fluid bg-transparent">
        <p style="font-size: 18px;">
            Informageek adalah sebuah platfrom berbasis website yang dapat digunakan
            <br>sebagai media dalam berbagi informasi tentang teknologi dan informasi. 
            <br>Informageek dapat juga disebut media sosial yang artinya setiap user bisa
            <br>saling berinteraksi dan saling berbagi informasi.
        </p>
        <div class="row">
            <div class="col-sm-6">
                <router-link class="btn btn-warning btn-lg rounded-pill join px-4 py-2" :to="{name: 'register'}">Bergabung Sekarang</router-link>
            </div>
            <div class="col-sm-6">
                <div class="image">
                    <img :src="'/media/home-img.png'"  class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.join{
    font-style: normal;
    font-weight: 600;
    font-size: 26px;
    line-height: 39px;
    text-align: center;
    margin: 0;
    color: #232B38;
}
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
