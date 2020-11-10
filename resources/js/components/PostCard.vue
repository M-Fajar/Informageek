<template>
<div>
    
  <div class="card"   v-for="(post, index ) in postData" :key="post.id">
      <div class="card-body" >
          <div class="media position-relative">
              <router-link :to="{name: 'profile',params: {username:postUser[index]}}">
              <img v-bind:src="'/media/avatar/'+ postPhoto[index]" id="avatar" alt="avatar" class="mr-3">
              </router-link>
              <div class="media-object">
                    <a :href="$router.resolve({name: 'profile',params: {username:postUser[index]}}).href">
                    <h5 class="mt-0"><b>{{ postUser[index] }}</b></h5>
                    </a>
                    <p >{{post.created_at | formatDate}}</p>
                
                  <a href="" class="position-absolute" style="top:0; right: 0;"><i class="fas fa-ellipsis-h fa-lg"></i></a>
              </div>
          </div>
            <p>
            <span style="margin-right: 4px;display:inline-block;" v-for="word in post.body.split(' ')" :key="word.id">
              <a v-if="word.charAt(0)=='#'" href="">{{word}}</a>
              <span style="" v-else>{{word}}</span>
            </span>
            </p>  
      </div>
      <div class="card-img-top">
          <img src="/media/frontend/kntn.png" class="img-fluid">
      </div>
      <div class="card-body">
          <div class="d-flex justify-content-around h3">
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-heart text-danger"></i> 33</a>
          
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-comment"></i> 3</a>
          
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-share"></i> 5</a>
          
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a>
          </div>
          <hr>
          <div class="d-flex align-items-center">
              <img v-bind:src="'/media/avatar/'+ userPhoto" id="avatar" alt="avatar" class="img-fluid">
              <div class="ml-3 flex-fill">
                  <input type="text" class="form-control rounded-pill" placeholder="Tuliskan Komentar">
              </div>
          </div>
      </div>
  </div>
  </div>
</template>

<style scoped>
.card {
  box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
  border: none;
  border-radius: 10px;
  margin-bottom: 15px;
}

    #avatar{    
    width: 2.7rem;
    object-fit: cover;
    height: 2.7rem;
    border-radius: 5vw;
}
.media-object h5 {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
</style>   

<script>
import axios from 'axios';

export default {

    props:{
        userPhoto: String,
    },
    data(){
        return{
            
            postData:{},
            postUser:{},
            postPhoto:{}
        }

    },
    watch:{
        
    },


    created: function(){
        axios.get("auth/posts",
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.postData = response.data.posts;
                this.postUser = response.data.username;
                this.postPhoto = response.data.foto;
               
               

            });
        
    },
    methods: {
        
        

        redirectPost() {
            console.log('clicked');
            this.$router.push('/post');
        }
    },

}
</script> 