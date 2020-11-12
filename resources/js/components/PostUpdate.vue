<template>
<div>
    
  <div class="card" v-for="(post) in postData" :key="post.id">
      <div class="card-body" >
          <div class="media position-relative">
              <img v-bind:src="'/media/avatar/'+ postFoto" id="avatar" alt="avatar" class="mr-3">
              <div class="media-object">
                
                  <h5 class="mt-0"><b>{{ postUser }}</b></h5>
                  <p>{{ post.created_at | formatDate}}</p>
                  <a href="" class="position-absolute" style="top:0; right: 0;"><i class="fas fa-ellipsis-h fa-lg"></i></a>
              </div>
          </div>

            <p v-html="replaceBody(post.body)" ></p>
            
      </div>
      <div class="card-img-top">
        
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
    width: 2.5rem;
    margin-left: 7px;
    object-fit: cover;
    height: 2.5rem;
    border-radius: 5vw;
}
</style>   

<script>
import axios from 'axios';

export default {

    props:{
        userPhoto: String,
        lastPost: Number
    },
    data(){
        return{
            
            postUser:null,
            postData:{},
            postFoto:null
            
        }

    },
    watch:{
        
    },


    created: function(){
        axios.get("auth/posts/last/"+ this.lastPost, 
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.postData = response.data.posts;
                this.postUser = response.data.username;
                this.postFoto = response.data.foto;
                console.log(this.postFoto)
                console.log(this.postUser)
               
            });
        
    },
    methods: {
        replaceBody(body){
             const hasil =  body.replace(/(?:\r\n|\r|\n)/g, '<br />')
            return hasil.replace(/#([\w]+)/g,'<a href="">#$1</a>')
        },
        

        redirectPost() {
            console.log('clicked');
            this.$router.push('/post');
        }
    },

}
</script> 