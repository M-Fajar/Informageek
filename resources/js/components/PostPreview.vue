  
 <template>
<div>
    
  <div class="card"   v-for="(post) in postData" :key="post.id">
      <div class="card-body " >
          <div class="media position-relative">
              <router-link :to="{name: 'profile',params: {username:postUser[post.id]}}">
              <img v-bind:src="'/media/avatar/'+ postPhoto[post.id]" id="avatar" alt="avatar" class="mr-3 img-post">
              </router-link>
              <div class="media-object">
                     <router-link :to="{name: 'profile',params: {username:postUser[post.id]}}">
                    
                    <h5 class="mt-0"><b>{{ postUser[post.id] }}</b></h5>
                     </router-link> 
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
                   <v-btn v-if="postFavorite[post.id] == true  "
                    icon
                    color='red'
                    >
                    <v-icon large>mdi-heart</v-icon>
                    </v-btn>
                    <v-btn v-else
                    icon
                  
                    >
                    <v-icon large>mdi-heart-outline</v-icon>
                    </v-btn>
                  <!-- <i  v-if="postFavorite[post.id] == true"  class="fas fa-heart text-danger"></i>
                  <i v-else  class="fas fa-heart "></i> -->
                    {{postLikes[post.id]}}</a>
          
              <a   @click="showComment(post.id)" class="text-secondary text-decoration-none pointer"><v-icon large>mdi-chat-outline</v-icon>
              {{postComment[post.id]}} </a>
          
              <a @click="sharePost(post.id)" data-toggle="modal" data-target="#exampleModalCenter" class="text-secondary text-decoration-none"><v-icon large>mdi-share-variant</v-icon></a>

              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-0">
                    <div class="modal-header text-center d-block">
                        <h5 class="modal-title d-inline-block" id="exampleModalLongTitle">Bagikan Postingan</h5>
                        <button style="width:50px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="row mb-2">
                           <div class="col-2 offset-3 pointer">
                                <facebook :url="shareUrl" scale="3" class="mr-3"></facebook>
                            </div> 
                            <div class="col-2 pointer">
                                <whats-app :url="shareUrl" title="Infromageek" scale="3"></whats-app>
                            </div>
                            <div class="col-2 pointer">
                                <telegram :url="shareUrl" scale="3" class="ml-3"></telegram>
                            </div>
                        </div>
                
                        <v-btn @click="copyText" small style="width: 60%">Salin Tautan</v-btn>
                    </div>
                    </div>
                </div>
                </div>
             
<!--           


              <a class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a> -->
          </div>    
        
          <hr>
          <transition name="fade">
          <div v-if="expandComment[post.id] == true">
           
            <div v-for="(item,index) in commentData[post.id]" :key="item.id" class="parrent-comment">
              <a v-show="index == 0 && !(moreComment[post.id] >= commentData[post.id].length)" @click="setMoreComment(post.id)" class="text-succes pointer"><p >Lihat komentar lain</p></a>
               
            
            <div :class="[commentData[post.id].length - index <= moreComment[post.id]? '' : 'hide']">
            <div class="comment "  >
                <img v-bind:src="'/media/avatar/'+ item.user.foto" alt="avatar" class="img-fluid img-circle img-comment">
                <div class="single-comment">
                    <h6>{{item.user.username}}</h6>
                    <p>{{item.comment}}</p>
                </div>
                
            </div> 
            <div class="comment-reply parrent-reply"> 
                        <span @click="showReply(item.id)" class="text-secondary pointer font-weight-bold"> Balas</span>
                        <span class="ml-1">.</span>
                        <span class="text-secondary ml-1 font-weight-light" >{{item.created_at|dateComment}} </span>
                        
            </div>
            <div v-for="child in item.child" :key="child.id" class="child-comment">
               

                    <div class="comment " >
                        <img v-bind:src="'/media/avatar/'+child.user.foto" alt="avatar" class="img-fluid img-circle">
                            <div class="single-comment">
                                <h6>{{child.user.username}}</h6>
                           
                                <p>{{child.comment}}</p>
                        </div>           
                    </div>
                    <div class="comment-reply "> 
                        <span @click="showReply(item.id)" class="text-secondary pointer"> Balas</span>
                        <span class="ml-1">.</span>
                    <span class="text-secondary ml-1 font-weight-light" >{{child.created_at|dateComment}} </span>
                    </div>
               
            </div>
            
            
            </div>
            </div>
          </div>
          </transition>

        
      </div>
  </div>
  </div>
</template>

<style scoped>

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
.pointer{
    cursor: pointer;
}
.close { 
  position: absolute; 
  right: 1rem;
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
     
        likePost(key)  {
          this.$router.push('/login');
        },
        commentSend(key){
           let comment = this.textComment[key];
           this.textComment[key] = null
           if(comment != null && this.textComment[key] == null)
           this.storeComment(key,comment,null)
           if(this.expandComment[key] == true)
                    Vue.set(this.moreComment,key,this.moreComment[key]+=1)  
            else{
                    Vue.set(this.expandComment,key,true)
                    Vue.set(this.moreComment,key,1)  
            }
                
                
        },
        replySend(key,parrent){
            let comment = this.textReply[parrent];
            this.textReply[parrent] = null
            if(comment != null && this.textReply[parrent] == null)
            this.storeComment(key,comment,parrent)
        },
        storeComment(key,comment,parrent){

            axios.post('auth/posts/comment', {
                    post_id: key,
                    comment: comment,
                    parent_id:parrent
                    }, 
                    {
                headers: {
                    Authorization: 'Bearer ' + 
                    this.$store.state.auth.token
                }
            })
            .then(response => {
                Vue.set(this.postComment,key,response.data.count)
                Vue.set(this.commentData,key,response.data.comment)
                
                
            })
        },
         replaceBody(body){
             const hasil =  body.replace(/(?:\r\n|\r|\n)/g, '<br />')
            return hasil.replace(/#([\w]+)/g,'<a href="">#$1</a>')
        },
        showComment(key){
            if(this.expandComment[key] == null || this.expandComment[key]== false){
                Vue.set(this.expandComment,key,true) 
                Vue.set(this.moreComment,key,4) 
                axios.get("auth/posts/comment/noauth/"+key).then(response => {
                Vue.set(this.commentData,key,response.data.comments)
               
                })
            }
            else{
                Vue.set(this.expandComment,key,false)  
            }
            
        },
        setMoreComment(key){
            Vue.set(this.moreComment,key,this.moreComment[key]+=4) 
        },
        setMoreReply(key){
            Vue.set(this.moreReply,key,this.moreReply[key]+=4) 
           
        },

        showReply(comment){
           if(this.replyComment[comment] == null)
            Vue.set(this.replyComment,comment,true)
            else
            Vue.set(this.replyComment,comment,!this.replyComment[comment])
          
            
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
        }

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