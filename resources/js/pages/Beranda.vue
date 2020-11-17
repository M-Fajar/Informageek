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
                                        <li class="list-inline-item" data-toggle="modal" data-target="#orangeModalSubscription" >
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
        <div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-warning" role="document">
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
            <textarea name="postData" class="form-control status-model "  v-model="postData" placeholder="Ide apa hari ini"></textarea>
            

             
            <div class="scroll">
            <div class="imagePreviewWrapper"  v-for="(image,key) in previewImage" :key="key">
                <div class="img-wrap" v-if="image != null">
                        <div class="btn-clear" @click="clearPreview(key)">
                        <span class="close">&times;</span>               
                        </div>
                        <img  :src="image" :ref="'image'" />
                </div>        
                        
            </div>
            </div>
            
          

           
            <div  class="fileUpload btn">
            <span >Tambah Foto</span>
            <input type="file" class="upload" name="file" ref="fileInput" multiple @change="pickFile" />
            </div>

        </div>
            </div>

      <!--Footer-->
                    <div class="modal-footer justify-content-center">
                          <a type="button"  data-dismiss="modal"  class="btn btn-warning waves-effect">Post <i class="fas fa-paper-plane-o ml-1"></i></a>
                    </div>
                </div>
            <!--/.Content-->
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

.modal-footer .btn{
    width: 100%;
    color:white;
    font-weight: 600;
}
.status-model{
    display:inline-block;
    min-height:     100px;
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
    left: 37%;
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
    top: 3px;
    border-radius: 50%;
    right: 2px;
    z-index: 100;
    background: #20202093;
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
            reload: true,
            images:[],
            previewImage: {},
        }

    },
    watch:{     
        
    },
    methods: {
        clearPreview(key){
            let panjangImage = this.images.length
            this.images.splice(key,1)
            for(let i=0;i<panjangImage;i++){
                console.log('tesfor')
                if(i == key){
                    key++
                    if(key == this.panjangImage ){
                        Vue.delete(this.previewImage,i)
                    }
                    else{
                    Vue.set(this.previewImage,i,this.previewImage[key])
                    }
                    console.log(i)
               }
            }
            
            console.log(this.images)
            console.log(this.previewImage)
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
                
                
                Vue.set(this.previewImage,this.images.length-1,URL.createObjectURL(input.files[i]))
               
                           }

            reader.readAsDataURL(file[i])
            this.$emit('input', file[i])
            }
            }else{
            alert('Ukuran tidak lebih dari 2 MB')
            }
        
        }
        console.log(this.images)
        console.log(this.previewImage)
     

    },
      
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
                this.postData = null
                this.hashtag =[]
           
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