  
 <template>
<div>
    
  <div class="card"   v-for="(post) in postData" :key="post.id">
      <div class="card-body " >
          <div class="media position-relative">
              <router-link :to="{name: 'profile',params: {username:postUser[post.id]}}">
              <img v-bind:src="'/media/avatar/'+ postPhoto[post.id]" id="avatar" alt="avatar" class="mr-3 img-post">
              </router-link>
              <div class="media-object">
                     
                    <a :href="$router.resolve({name: 'profile',params: {username:postUser[post.id]}}).href">
                    <h5 class="mt-0"><b>{{ postUser[post.id] }}</b></h5>
                    </a>
                    <p >{{post.created_at | formatDate}}</p>
                
                  <a href="" class="position-absolute" style="top:0; right: 0;"><i class="fas fa-ellipsis-h fa-lg"></i></a>
              </div>    
          </div>
             <p v-html="replaceBody(post.body)" ></p>
            
      </div>
      <div class="card-img-top ">
          <lightbox :items="postThumbnails[post.id]"></lightbox>
      </div>

      <div class="card-body">
          <div class="d-flex justify-content-around h3      ">
              <a  class="text-secondary text-decoration-none pointer" @click="likePost(post.id)">
                  <i  v-if="postFavorite[post.id] == true"  class="fas fa-heart text-danger"></i>
                  <i v-else   class="fas fa-heart "></i>
                    {{postLikes[post.id]}}</a>
          
              <a href="#"  class="text-secondary text-decoration-none"><i class="far fa-comment"></i>{{postComment[post.id]}} </a>
          
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-share"></i> 5</a>
          
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a>
          </div>    
        
          <hr>
          <!-- <Comment :post_id = "post.id"/> -->
          <div class="comment" v-if="commentData[post.id]">
                                        
              <img v-bind:src="'/media/avatar/'+ user.foto" alt="avatar" class="img-fluid img-post img-comment">
                                    <div class="single-comment">
                                        
                                        <h6>{{user.username}}</h6>
                                        
                                        {{commentData[post.id]}}<br>
                            
                                    </div>
                                   
                            </div>   
          <div class="d-flex align-items-center">
              
              <img v-bind:src="'/media/avatar/'+ user.foto" alt="avatar" class="img-fluid img-post img-comment">
              
              <div class="ml-3 flex-fill">
                  <input type="text" @keyup.enter="commentSend(post.id)" v-model="textComment[post.id]" class="form-control rounded-pill" placeholder="Tuliskan Komentar">
                    
              </div>
              
              <img class="btn" id="btn-comment" @click="commentSend(post.id)" src="/media/frontend/send.png" alt="">
              
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

    .img-post{    
    
    object-fit: cover;
    
    border-radius: 5vw;
    
}
#avatar{
    width: 3rem;
    height: 3rem;
}
.media-object h5 {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
#btn-comment{
    cursor: pointer;
}
.comment p {
            display: inline;
         
        }
.comment h6 {
            font-weight: 700;
            padding: 0;
            margin: 0 0 .25rem;
}
.pointer{
    cursor: pointer;
}
        
.single-comment{
    margin-left: 10px;
    display: inline-block;
    background: #f9f9f9;
    font-size: 13pt;
    flex-grow: 1;
    padding: 0.5em 10px;    
    border-radius: 10px;
}
.comment{
    display: flex;
    margin: 1.5em 10px;
}
.img-comment{   
    height: 2.5rem;
    width: 2.5rem;
}
.white {
       color: hsl(0, 5%, 75%);

   }
   .red {color: rgb(240, 56, 56);

   }
</style>   

<script>

import { mapGetters,mapActions } from "vuex"
import axios from 'axios';
import Lightbox from '@morioh/v-lightbox/src/lightbox';
// stylsheet
import '@morioh/v-lightbox/dist/lightbox.css';
import Comment from '../components/Comment';
export default {

    components:{
        Lightbox,
        Comment
    },
    data(){
        return{
            
            postData:{},
            postUser:{},
            postPhoto:{},
            postLikes:{},
            postFavorite:{},
            postComment:{},
            postThumbnails:{},
            commentData:{},
            textComment:{},
            likesStatus:{},
        }

    },
    watch:{
      


    },


    
    methods: {
     
        likePost(key)  {
            axios.post('auth/posts/like',{
                post_id: key
            },{
            headers:{
                Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            }
            ).then(response =>{
                Vue.set(this.postLikes,key,response.data.likes)
                
                Vue.set(this.postFavorite,key,!this.postFavorite[key])
                this.clicked = !this.clicked        
               
            })
            
        },
        commentSend(key){
           let comment = this.textComment[key];
           this.commentData[key] = this.textComment[key];
           this.textComment[key] = null
           if(comment != null && this.textComment[key] == null)
            axios.post('auth/posts/comment', {
                    post_id: key,
                    comment: comment
                    }, 
                    {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                Vue.set(this.postComment,key,response.data.count)
            })
        },
         replaceBody(body){
             const hasil =  body.replace(/(?:\r\n|\r|\n)/g, '<br />')
            return hasil.replace(/#([\w]+)/g,'<a href="">#$1</a>')
        },
        redirectPost() {
            
            console.log('clicked');
            this.$router.push('/post');
        }
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
                this.postLikes  = response.data.likes;   
                this.postFavorite = response.data.favorite;
                this.postThumbnails = response.data.thumbnail;
                this.postComment = response.data.comment;
                
               this.loaded = true

            });
        
    },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        }),
    }

}
</script> 