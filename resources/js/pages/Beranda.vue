<template>
    <div class="container-fluid">
        <div class="row">
                <!-- Sidebar Kanan -->
            <div class="col-md-3">
                <SidebarLeftHome/>
            </div>
            <!-- Beranda Tengah -->
            <div class="col-md-6 py-3">
                <div class="media post p-3">
                    <img src="/media/frontend/sugiono.png" class="mr-3" alt="avatar">
                    <div class="media-body">
                        <input type="text" class="form-control status" placeholder="Ide apa hari ini">
                        <div class="mt-2">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#"><i class="far fa-image fa-2x"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="far fa-map fa-2x"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="far fa-user fa-2x"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><i class="far fa-smile-wink fa-2x"></i></a>
                                </li>
                                <li class="list-inline-item float-right">
                                    <button type="button" class="btn btn-warning rounded-pill">Kirim</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post p-3">
                                <div class="media position-relative">
                                    <img src="/media/frontend/sugiono.png" class="mr-3" alt="avatar">
                                    <div class="media-object">
                                        <h5 class="mt-0"><b>Prof Sugiono</b></h5>
                                        <p>99 Tahun yang lalu</p>
                                        <a href="" class="position-absolute" style="top:0; right: 0;"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            Apa perbedaan HTML dan CSS ?
                                            <br>Yang tau komen d bawah guys nanti dapet give away video saya..
                                            <br>
                                            <a href="">#CodingGarisKeras</a>
                                        </p>
                                        <img src="/media/frontend/kntn.png" width="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar Kanan -->
            <div class="col-md-3">
                <SidebarRightHome/>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container-fluid {
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}
.beranda{
    background-color: #F9F8F8;
}

/*Beranda Tengah*/
.post{
    background-color: #fff;
    box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
}
.post .status{
    background: #F9F8F8;
    border-radius: 45px;
    height: 45px;
    top: 15px;
}
</style>

<script>
import SidebarLeftHome from '../components/SidebarLeftHome';
import SidebarRightHome from '../components/SidebarRightHome';
export default {
    components: {
        SidebarLeftHome,
        SidebarRightHome,
    }
}
</script>