  
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
                  <i v-else  class="fas fa-heart "></i>
                    {{postLikes[post.id]}}</a>
          
              <a   @click="showComment(post.id)" class="text-secondary text-decoration-none pointer"><i class="far fa-comment"></i> 
              {{postComment[post.id]}} </a>
          
              <a class="text-secondary text-decoration-none"><i class="fas fa-share"></i> 5</a>
          
              <a class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a>
          </div>    
        
          <hr>
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
                    <span class="text-secondary ml-1 font-weight-light" >{{item.created_at|dateComment}} </span>
                    </div>
               
            </div>
            
            <div v-if="replyComment[item.id] == true" class="d-flex align-items-center  child-comment ml-1 mb-3">
                <img v-bind:src="'/media/avatar/'+ user.foto" alt="avatar" class="img-fluid img-post">
                <div class="ml-2 flex-fill">
                  <input type="text" @keyup.enter="replySend(post.id,item.id)" v-model="textReply[item.id]" class="form-control form-control-sm rounded-pill" placeholder="Balasan">
                </div><img id="btn-balas" @click="replySend(post.id,item.id)" src="/media/frontend/send-small.png" alt="">  
            </div>
            </div>
        </div>
        </div>

        <div class="d-flex align-items-center">
              
              <img v-bind:src="'/media/avatar/'+ user.foto" alt="avatar" class="img-fluid img-post img-comment">
              
              <div class="ml-3 flex-fill">
                  <input type="text" @keyup.enter="commentSend(post.id)" v-model="textComment[post.id]" class="form-control rounded-pill" placeholder="Tuliskan komentar">
                    
              </div>
              
              <img class="btn" id="btn-comment" @click="commentSend(post.id)" src="/media/frontend/send.png" alt="">
              
          </div>
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
            expandComment:{},
            moreComment:{},
            moreReply:{},
            replyComment:{},
            textReply:{}

            }   

    },
    watch:{
      


    },


    
    methods: {
     
        likePost(key)  {
            Vue.set(this.postFavorite,key,!this.postFavorite[key])
            Vue.set(this.postLikes,key,(this.postFavorite[key]== true? this.postLikes[key]+=1:this.postLikes[key]-=1))
            axios.post('auth/posts/like',{
                post_id: key
            },{
            headers:{
                Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            }
            ).then(response =>{
                // Vue.set(this.postLikes,key,response.data.likes)
                
                
                this.clicked = !this.clicked        
               
            })
            
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
                axios.get("auth/posts/comment/"+key,{
                    headers:{
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
                }).then(response => {
                Vue.set(this.commentData,key,response.data.comments)
                console.log(this.commentData)
                console.log(this.expandComment)
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
            console.log(this.moreReply)
        },

        showReply(comment){
           if(this.replyComment[comment] == null)
            Vue.set(this.replyComment,comment,true)
            else
            Vue.set(this.replyComment,comment,!this.replyComment[comment])
            console.log(this.replyComment)
            
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