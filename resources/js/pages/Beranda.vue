<template>
    <div class="container-fluid">
        <div class="row">
                <!-- Sidebar Kiri -->
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
                                


                                <textarea  name="postData" class="form-control status" v-model="postData" placeholder="Ide apa hari ini"></textarea>
                                
                                <div class="mt-2">
                                    <ul class="list-inline h3">
                                        <li class="list-inline-item" data-toggle="modal" data-target="#orangeModalSubscription" >
                                            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-image"></i></a>
                                        </li>
                                            
                                        <li class="list-inline-item float-right">
                                            <v-btn color="yellow" @click='postCreate' dark rounded elevation="4" >Kirim</v-btn>
                                            <!-- <button type="button" @click='postCreate' class="btn btn-warning rounded-pill px-4">Kirim</button> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="inUpload">
                    <span>Mengunggah...</span>
                 <v-progress-linear
                    indeterminate
                    color="yellow darken-2"
                    height="7px"
                    rounded

                    ></v-progress-linear>
                </div>
                
                
                <PostUpdate v-if="postUpdated != null" :listPost="postUpdated"/>
                
                 

                <div class="timeline mt-3"> 

                    <PostCard v-if="listPost!=null" :listPost="listPost"/>

                </div>
            </div>
            <!-- Sidebar Kanan -->
            <div class="col-md-3">
                <SidebarRightHome/>
            </div>
        </div>
        <div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-warning modal-lg" role="document">
    <!--Content-->
        <div class="modal-content">
      <!--Header-->
          <div class="modal-header text-center">
            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Create Post</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>

      <!--Body-->
        <div class="modal-body">
          <div>
            <v-textarea
          label="Ide apa hari ini ?"
          auto-grow
          outlined
          rows="2"
          row-height="12"
          name="postData"
          v-model="postData"
        ></v-textarea>  
            
            

             
            <div class="scroll">
            <div class="imagePreviewWrapper"  v-for="(image,key) in previewImage" :key="key">
                <div class="img-wrap" v-if="image != null">
                        <div class="btn-clear" @click="clearPreview(key)">
                            <v-icon>mdi-close</v-icon>
                        </div>
                        <img  :src="image" :ref="'image'" />
                </div>        
                        
            </div>
            </div>
            
            <div  class="fileUpload btn">
                    <v-btn
                color="blue-grey"
                class="ma-2 white--text"
            > Upload
            <v-icon dark right>
                mdi-image-plus
            </v-icon>
            <input type="file" class="upload" name="file" ref="fileInput" multiple @change="pickFile" />
            </v-btn>
            
            
            </div>

        </div>
            </div>

      <!--Footer-->
                    <div class="modal-footer justify-content-center">
                                    <v-btn
                        color="amber"
                        dark
                        style="width:100%"
                        @click="postCreate" 
                        data-dismiss="modal"
                        :disabled="enableBtn"
                        >
                        Post
                        </v-btn>
                          
                    </div>
                </div>
            <!--/.Content-->
            </div>
        </div>
    </div>


    
</template>


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
            
           
            postData:null,
            hashtag:[],
            images:[],
            file:'',
            previewImage: {},
            postUpdated:null,
            listPost:null,
            inUpload:false
        }

    },
    watch:{     
        
    },
    methods: {
        
        clearPreview(key){
            let panjangImage = this.images.length
            this.images.splice(key,1)
            for(let i=0;i<panjangImage;i++){
               
                if(i == key){
                    key++
                    if(key == this.panjangImage ){
                        Vue.delete(this.previewImage,i)
                    }
                    else{
                    Vue.set(this.previewImage,i,this.previewImage[key])
                    }
                    
               }
            }
            
        },
        pickFile () {
        
        let input = this.$refs.fileInput;
        let file = input.files;
        let index;
        
        for(let i = 0 ;i<file.length;i++){
            if(file[i]['size'] < 3111775){                
            if (file && file[i]) {
            let reader = new FileReader
            reader.onload = e => {
                this.images.push(input.files[i])
                this.file = file[0];
                
            
                    Vue.set(this.previewImage,this.images.length-1,URL.createObjectURL(input.files[i]))
               
                           }

            reader.readAsDataURL(file[i])
            this.$emit('input', file[i])
            }
            }else{
            alert('Ukuran tidak lebih dari 2 MB')
            }
        
        }
      
     

    },
      
        postCreate(){
            this.inUpload = true
            var regexp = /#(\w+)/g;
            var match = regexp.exec(this.postData);
           
            let formData = new FormData();
            formData.append('body',this.postData);

            let i= -1;
            while (match != null){
                i++;
                formData.append('categories['+i+']',match[1]);
                match = regexp.exec(this.postData)
            } 
              
            
            for(i=0;i < this.images.length;i++){
                
                formData.append('photo_id['+i+']',this.images[i]);
            }
            
            axios.post("http://localhost:8000/api/auth/posts/store",formData,
            {
                headers: {
                     'content-type': 'multipart/form-data',
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
              
                }
            })
            .then(response => {    
                this.previewImage = {}
                this.postUpdated = response.data
                this.postData = null
                this.hashtag =[]
                this.images = []
                this.inUpload=false
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
        enableBtn() {
       
        if(this.postData == null || this.postData.length==0)
          return true
        return false
			},
    },
    mounted: function(){
        
        axios.get("auth/posts",
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.listPost = response.data
                console.log(this.listPost)    


            });
    }
}
</script>   
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

.modal-footer .btn{
    width: 100%;
    color:white;
    font-weight: 600;
}
.status-model{
    display:inline-block;
    min-height:     150px;
    resize: none;
}


div.scroll {
  background-color: white;
  max-height: 190px;
  width: 100%;
  overflow-y: scroll;
}

.fileUpload {
    position: relative;
    overflow: hidden;
    left: 40%;
    cursor: pointer;
    margin-bottom: -20px;
    color:hsl(51, 100%, 50%) ;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.imagePreviewWrapper {
    margin: 3px;
    display: inline-block ;
    justify-content: left;
    align-items: left;
}   
.img-wrap{
    position: relative;

}
.imagePreviewWrapper img{

  max-width: 100%;
  max-height: 165px;
}
.btn-clear .close {
    position: absolute;
    right: 3.5px;
    color: #F9F8F8;
}
.btn-clear{
    cursor: pointer;
    width: 20px;
    height: 20px;
    position: absolute;
    top: 1px;
    right: 4px;
    z-index: 100;
   
}
</style>
