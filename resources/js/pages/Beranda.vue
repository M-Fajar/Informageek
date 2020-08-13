<template>
    <div class="container-fluid">
        <div class="row">
                <!-- Sidebar Kanan -->
            <div class="col-md-3">
                <SidebarLeftHome/>
            </div>
            <!-- Beranda Tengah -->
            <div class="col-md-6 py-3">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <img src="/media/frontend/sugiono.png" class="mr-3" alt="avatar">
                            <div class="media-body">
                                <input type="text" class="form-control status" placeholder="Ide apa hari ini">
                                <div class="mt-2">
                                    <ul class="list-inline h3">
                                        <li class="list-inline-item">
                                            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-image"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-map"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-user"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-smile-wink"></i></a>
                                        </li>
                                        <li class="list-inline-item float-right">
                                            <button type="button" class="btn btn-warning rounded-pill px-4">Kirim</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline mt-3">
                    <PostCard @click.native="redirectPost"/>
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
.card{
    box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
    border: none;
    border-radius: 10px;
}
.status{
    background: #F9F8F8;
    border-radius: 45px;
    height: 45px;
    top: 15px;
}
</style>

<script>
import SidebarLeftHome from '../components/SidebarLeftHome';
import SidebarRightHome from '../components/SidebarRightHome';
import PostCard from '../components/PostCard';
export default {
    components: {
        SidebarLeftHome,
        SidebarRightHome,
        PostCard,
    },
    methods: {
        redirectPost() {
            console.log('clicked');
            this.$router.push('/post');
        }
    },
}
</script>