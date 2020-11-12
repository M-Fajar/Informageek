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
                            <img v-bind:src="'/media/avatar/' + user.foto" class="mr-3"  alt="avatar">
                            <div class="media-body">
                                <textarea name="postData" class="form-control status" v-model="postData" placeholder="Ide apa hari ini"></textarea>
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

                <div class="timeline mt-3"  v-if="postSucces > 0 && reload" >

                <PostUpdate  :userPhoto="user.foto"  :lastPost="postSucces"/>
                
                 
                </div>
                <div class="timeline mt-3"> 

                    <PostCard  :userPhoto="user.foto"/>

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
.media img{
    width: 2.5rem;
    margin-left: 7px;
    height: 2.5rem;
    object-fit: cover;
    border-radius: 50%;
}
</style>

<script>
import { mapGetters,mapActions } from "vuex"
import SidebarLeftHome from '../components/SidebarLeftHome';
import SidebarRightHome from '../components/SidebarRightHome';
import PostCard from '../components/PostCard';
import PostUpdate from '../components/PostUpdate';
import axios from 'axios';
export default {
    components: {
        SidebarLeftHome,
        SidebarRightHome,
        PostCard,
        PostUpdate
    },
    
    data(){
        return{
            message:"",
            postData:'',
            hashtag:[],
            postSucces: 0,
            reload: true
        }

    },
    watch:{
        
    },
    methods: {
        
        postCreate(){
            
            var regexp = /#(\w+)/g;
            var match = regexp.exec(this.postData);
            console.log(this.postData)

            while (match != null){
            
            this.hashtag.push(match[1])
            match = regexp.exec(this.postData)
            } 
            this.reload= false
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
                
                this.postSucces += 1
                this.reload= true
           
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