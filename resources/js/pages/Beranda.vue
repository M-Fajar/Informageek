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
                            <img v-bind:src="'/media/profile/' + user.foto" class="mr-3" alt="avatar">
                            <div class="media-body">
                                <input type="text" class="form-control status" name="postData"  v-model="postData" placeholder="Ide apa hari ini">
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
                                            <button type="button" @click='postCreate' class="btn btn-warning rounded-pill px-4">Kirim</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timeline mt-3">

                    <PostCard @click.native="redirectPost" />

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
import { mapGetters,mapActions } from "vuex"
import SidebarLeftHome from '../components/SidebarLeftHome';
import SidebarRightHome from '../components/SidebarRightHome';
import PostCard from '../components/PostCard';
import axios from 'axios';
export default {
    components: {
        SidebarLeftHome,
        SidebarRightHome,
        PostCard,
    },
    data(){
        return{
            message:"",
            postData:'',
            hashtag:[]
        }

    },
    watch:{
        
    },
    methods: {
        
        postCreate(){
            var regexp = /#(\w+)/g;
            var match = regexp.exec(this.postData);
            while (match != null){
            console.log(match[1])
            this.hashtag.push(match[1])
            match = regexp.exec(this.postData)
            } 
            console.log(this.hastag)
            axios.post("http://localhost:8000/api/auth/posts/store", {
               
                body: this.postData,
                categories: this.hashtag
               
            },
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.message = response.data.status;
                console.log(this.message);
            });
        },

        redirectPost() {
            console.log('clicked');
            this.$router.push('/post');
        }
    },
     computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        }),
    }
}
</script>   