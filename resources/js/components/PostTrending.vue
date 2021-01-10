  
 <template>
<div>
    
  <div class="card pb-4"   v-for="(post) in postData" :key="post.id" @click="redirectPost(post.id)">
      <div class="card-body " style="margin-bottom:-30px">
          <div class="media position-relative" style="margin-bottom:-28px">
              <router-link :to="{name: 'profile',params: {username:postUser[post.id]}}">
              <img v-bind:src="'/media/avatar/'+ postPhoto[post.id]" id="avatar" alt="avatar" class="mr-3 img-post">
              </router-link>
             
              <div class="media-object">
                     <router-link :to="{name: 'profile',params: {username:postUser[post.id]}}">
                    
                    <h6 class="mt-0"><b>{{ postUser[post.id] }}</b></h6>
                     </router-link> 
                    <p >{{post.created_at | formatDate}}</p>
                

              </div>    
               
          </div>
          <hr>
             <p v-html="replaceBody(post.body)" ></p>
            
      </div>
      <div class="card-img-top " v-if="postThumbnails[post.id].length > 0">
           <img :src="'/media/posts/'+postThumbnails[post.id][0]" alt="">
      </div>
         
        
      <div class="card-body" style="margin-bottom:-30px;margin-top:-17px">
          <div class="d-flex justify-content-around h3">
              <a  class="text-secondary text-decoration-none pointer" >
                   <v-btn v-if="postFavorite[post.id] == true"
                    icon
                    color='red'
                    >
                    <v-icon >mdi-heart</v-icon>
                    </v-btn>
                    <v-btn v-else
                    icon
                  
                    >
                    <v-icon>mdi-heart-outline</v-icon>
                    </v-btn>
                  <!-- <i  v-if="postFavorite[post.id] == true"  class="fas fa-heart text-danger"></i>
                  <i v-else  class="fas fa-heart "></i> -->
                    <span class="fontCount">{{postLikes[post.id]}} </span></a>
          
              <a   class="text-secondary text-decoration-none pointer"><v-icon>mdi-chat-outline</v-icon>
                <span class="fontCount">{{postComment[post.id]}} </span> </a>
          
              <a  data-toggle="modal" data-target="#exampleModalCenter" class="text-secondary text-decoration-none"><v-icon>mdi-share-variant</v-icon></a>

             
<!--           


              <a class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a> -->
          </div>  

      
      </div>
  </div>
  </div>
</template>

<style scoped>

#avatar{
    width: 2rem;
    height: 2rem;
}
.media-object h6 {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
#btn-comment{
    cursor: pointer;
}
.pointer{
    cursor: pointer;
}
.close { 
  position: absolute; 
  right: 1rem;
}
p {
    font-size: 12px;
}
.fontCount{
    font-size: 18px;
}
        


</style>   

<script>

import { mapGetters,mapActions } from "vuex"
import axios from 'axios';
import Lightbox from '@morioh/v-lightbox/src/lightbox';
import {
  Facebook,
  Telegram,
  WhatsApp,
} from "vue-socialmedia-share";
// stylsheet
import '@morioh/v-lightbox/dist/lightbox.css';
import Comment from '../components/Comment';
export default {

    components:{
        Lightbox,
        Comment,
        Facebook,
        Telegram,
        WhatsApp
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
            expandComment:{},
            moreComment:{},
            moreReply:{},
            replyComment:{},
            textReply:{},
            shareUrl:'',
            dialog:false

            }   

    },
    props:{
        listPost:{
            default:null
        }
    },

    
    methods: {
     
     
         replaceBody(body){
             if(body.length>200){
                 body =  body.substring(0,200)+'<span link class="text-primary pointer">..Lihat Selengkapnya</span>';
             }
             const hasil =  body.replace(/(?:\r\n|\r|\n)/g, '<br />')
            return hasil.replace(/#([\w]+)/g,'<a href="">#$1</a>')
        },
        redirectPost() {
            
            console.log('clicked');
            this.$router.push('/post');
        },
        storeData(listPost){
            if(this.listPost!=null){
                this.postData = this.listPost.posts;
                this.postUser = this.listPost.username;
                this.postPhoto = this.listPost.foto;
                this.postLikes  = this.listPost.likes;   
                this.postFavorite = this.listPost.favorite;
                this.postThumbnails = this.listPost.thumbnail;
                this.postComment = this.listPost.comment;
            }
            else this.postData=null
        },
        sharePost(id){
            axios.get('auth/posts/share/'+id).then(response =>{  
                this.shareUrl = response.data
                
            })
        },
        copyText () {
          navigator.clipboard.writeText(this.shareUrl);
        },
         redirectPost(key) {
            
          
            this.$router.push('/post/'+btoa(key));
        },

    },
    created: function(){
        this.storeData(this.listPost)    
    },
    mounted:function(){
          this.showComment(this.postData[0].id)
    },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        }),
    },
    
    watch:{
        listPost(value){
            this.storeData(value)
        }
    },

    

}
</script> 