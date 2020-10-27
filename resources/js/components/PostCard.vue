<template>
<div>
  <div class="card" v-for="(post) in postData" :key="post.id">
      <div class="card-body">
          <div class="media position-relative">
              <img src="/media/frontend/sugiono.png" class="mr-3" alt="avatar">
              <div class="media-object">
                  <h5 class="mt-0"><b>{{ post.user_id }}</b></h5>
                  <p>{{post.created_at | formatDate}}</p>
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
              <img src="/media/frontend/profile.png" class="img-fluid">
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
</style>   

<script>
import axios from 'axios';

export default {
    data(){
        return{
            postData:{},
        }

    },
    watch:{
        
    },

    created: function(){
        axios.get("http://localhost:8000/api/auth/posts",
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.postData = response.data.posts;
                console.log(this.postData)
          

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