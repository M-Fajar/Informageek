<template>
    <div class="b-left shadow-sm">
        <h4 class="pl-3 pt-2">Grup BSO</h4>
        <div class="card grup ml-3 mr-3 position-relative">
            <img class="card-img-top" src="/media/frontend/bso_tawuran.png" alt="Card image cap">
            <div class="position-absolute badge badge-pill badge-warning px-3 m-2" style="top: 0; right: 0">
                <h4><i class="fas fa-users"></i> 999</h4>
            </div>
            <div class="bg-fadded">
                <h3 class="text-white pt-1 pl-2">BSO TAWURAN</h3>
                <p class="text-white pb-1 pl-2">Kumpulan manusia bar-bar</p>  

            </div>
            <div class="card-body">
                <p>Diikuti oleh</p>
            </div>
        </div>
        <div class="teman p-2">
            <h5 class="mt-4 ml-2">Teman</h5>
            <div class="online">
                <ul class="list-unstyled">
                    <li class="media">
                        <img src="/media/frontend/profile.png" class="mr-3 img-fluid">
                        <div class="media-object align-self-center">
                             Muhammad Ronaldo
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>
/*Beranda Kanan*/
.b-left{
    background-color: #fff;
    /* box-shadow: 4px 2px 4px rgba(0, 0, 0.25, 0.25); */

}
.b-left .grup{
    background-color: #fff;
    box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 15px;
}
.b-left .grup .bg-fadded{
    position: absolute;
    background: rgba(196, 196, 196, 0.5);
    top: 140px;
    width: 100%;
    height: 70px;
}
</style>