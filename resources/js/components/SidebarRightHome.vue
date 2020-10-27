<template>
    <div class="shadow">
        <h4 class="pl-3 pt-2">Grup BSO</h4>
        <div class="card border-0 rounded shadow ml-3 mr-3 position-relative">
            <div class="position-absolute badge badge-pill badge-warning px-3 m-2" style="top: 0; right: 0">
                <h4><i class="fas fa-users"></i> 999</h4>
            </div>
            <img class="card-img-top" src="/media/frontend/bso_tawuran.png" alt="Card image cap">
            <div class="bg-fadded">
                <h3 class="text-white pt-1 pl-2">BSO TAWURAN</h3>
                <p class="text-white pb-1 pl-2">Kumpulan manusia bar-bar</p>  
            </div>
            <div class="card-body">
                <div class="card-text d-flex justify-content-between align-items-center">
                    <p>Diikuti oleh</p>
                    <div>
                        <img src="/media/frontend/sugiono.png" alt="kakek" class="img-fluid">
                        <img src="/media/frontend/profile.png" alt="kakek" class="img-fluid" style="margin-left: -25px">
                        <img src="/media/frontend/sugiono.png" alt="kakek" class="img-fluid" style="margin-left: -25px">
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Teman</h5>
                <input type="text" class="form-control form-control-sm w-50 rounded-pill" placeholder="Cari" style="background-color: #F9F8F8;">
            </div>
            <ul class="list-unstyled mt-2">
                <li class="media align-items-center">
                    <img src="/media/frontend/profile.png" class="img-fluid">
                    <div class="media-object mx-3 flex-fill">
                            Muhammad Ronaldo
                    </div>
                    <div class="p-3">
                        <i class="fas fa-circle text-warning"></i>
                    </div>
                </li>
                <li class="media align-items-center">
                    <img src="/media/frontend/sugiono.png" class="img-fluid">
                    <div class="media-object mx-3 flex-fill">
                            Kakek Sugiono
                    </div>
                    <div class="p-3">
                        <i class="fas fa-circle text-warning"></i>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
/*Beranda Kanan*/
.bg-fadded{
    position: absolute;
    background: rgba(196, 196, 196, 0.5);
    width: 100%;
    top: 0;
    transform: translate(0, 115%);
}
</style>