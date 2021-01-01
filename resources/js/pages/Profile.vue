  <template>
  <div class="container-fluid">
   
    <div class="row">
      
      <div class="jumbotron-fluid hero" :style="{ backgroundImage: `url(${user.cover})` }">
             <div class="progress" v-if="progressBar > 0" >
                        <div class="progress-bar bg-warning" role="progressbar" 
                            :style="{width: progressBar + '%'}" 
                            :aria-valuenow="progressBar"
                            aria-valuemin="0" 
                            aria-valuemax="100"></div>
                        </div>
          <div v-if="user['username']== auth.username">
          <div class="edit-cover" data-toggle="modal" data-target="#orangeModalSubscription" @click="changeCover">
              <img class="camera" src="/media/frontend/camera.png" alt="">   
              <span id="upcover" >Edit Cover</span>

          </div>
          </div>    
          <div class="fotoprofil">
            <img id="foto" v-bind:src="'/media/profile/'+ user.foto" alt="avatar" class="img-fluid rounded-circle" @click="changeProfile">
             <div v-if="user['username']== auth.username">
            <div class="edit" data-toggle="modal" data-target="#orangeModalSubscription">
              <img  src="/media/frontend/screenshot.png" alt="" id="edit">
            </div>
             </div>
          </div>
      </div>
    </div>
    
    <div class="container p-5">
      <div class="row text-center">
        <div class="col-md-6 offset-md-3">
          <h1>{{user['name']}}</h1>
          <h5>{{user['username']}}</h5>
          <p class="my-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis nulla repellendus provident deserunt aspernatur. Architecto incidunt vitae quod deserunt omnis illum amet saepe sit commodi! Praesentium vero voluptatem ab nihil?</p>
          
          <div v-if="user['username']== auth.username">
            
              <button class="btn btn-primary btn-lg dropbtn">Edit Profil</button>
      
         </div>
          <button v-else class="btn btn-primary btn-lg">Follow</button>
          <hr>
          <ul class="list-unstyled">
            <PostPreview @click.native="redirectPost"/>
          </ul>
          <div class="d-flex justify-content-around h3">
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-heart text-danger"></i> 33</a>
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-comment"></i> 3</a>
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-share"></i> 5</a>
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Cover Upload -->
    <div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-notify modal-warning" role="document">
    <!--Content-->
        <div class="modal-content">
      <!--Header-->
          <div class="modal-header text-center">
            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Upload Photo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
            </button>
          </div>

      <!--Body-->
        <div class="modal-body">
          <div>
    <div v-if="previewImage != null"
      class="imagePreviewWrapper"
        @click="selectImage">
        <img :src="previewImage" alt="">
    </div>
    
    <div class="fileUpload btn btn-primary">
      <span>Pilih Berkas</span>
      <input type="file" class="upload" name="file" ref="fileInput"  @input="pickFile"/>
</div>

  </div>
       </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" @click="simpan" data-dismiss="modal"  class="btn btn-outline-warning waves-effect">Simpan <i class="fas fa-paper-plane-o ml-1"></i></a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>

  </div>
  
</template>

<style scoped>
.fileUpload {
    position: relative;
    overflow: hidden;
    left: 37%;
    margin: 10px;
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
.edit-cover{
  background:rgba(211,211,211, 0.5);
  width: 130px;
  padding-top: 3px; 
  height: 32px;
  bottom: 10%;
  left: 13%;
  padding-left: 10px;  
  border-radius: 7%;
  position: absolute;
   transform: translate(-50%, 50%);
   cursor: pointer;
  
}
.progress{
  height: 7px;
}

#upcover{
  color: #f1f1f1;
  font-weight: bold;
  display: inline;
  
}

.hero {
  /* background-image: url('https://picsum.photos/720/480'); */
  
  background-size: cover;
  background-position: center center;
  height: 50vh;
  width: 100%;
  position: relative;
}
.fotoprofil{
  position: absolute;
  bottom: 0;
  left: 50%;
  width: 16rem;
  height: 16rem;
}
.fotoprofil .edit{
  position: absolute;
  left: 26%;
  bottom: -36%;
  height: 40px;
  width: 40px;
  background-color:white ; 
  border-radius: 5vw;
  cursor: pointer;
}
.fotoprofil .edit #edit
{ position: absolute;
  left: 20%;
  bottom: 25%;

}
#foto{
  
  width: 16rem;
  height: 16rem;
  overflow: hidden;
  border-radius: 5vw;
   object-fit:cover;
  transform: translate(-50%, 50%);
  border: 10px solid white;
}
.imagePreviewWrapper {
    margin: 0 auto;
    display: flex;
  justify-content: center;
  align-items: center;
}   
.imagePreviewWrapper img{
  max-width: 100%;
  max-height: 300px;
}
.p-5 {
  margin-top:80px;
}
.dropdown:hover .dropbtn {
  background-color: darkblue;
}
</style>

<script>
import { mapGetters,mapActions } from "vuex"
import axios from 'axios'
import PostPreview from '../components/PostPreview';
import router from '../router'
export default {
  components: {
    PostPreview,
  },
  data(){
    return{
      user:[],
      previewImage: null,
      progressBar: 0,
      file:'',
      changeprofile: true, //cek button edit apa yang di klik
    }
  },
  methods: {
    redirectPost() {
      console.log('clicked');
      this.$router.push('/post');
    },
    selectImage () {
          this.$refs.fileInput.click()
      },
    pickFile () {
        let input = this.$refs.fileInput
        let file = input.files

        
        if(file[0]['size'] < 3111775){                
        if (file && file[0]) {
          let reader = new FileReader
          reader.onload = e => {
            this.file = input.files[0]
            this.previewImage =URL.createObjectURL(this.file)
           
          }
          
          reader.readAsDataURL(file[0])
          this.$emit('input', file[0])
          }
        }else{
           alert('Ukuran tidak lebih dari 2 MB')
        }

    },
    simpan(){
        if(this.previewImage == null){
          console.log('Pilih Berkas') 
        }else{
          let formData = new FormData();
                formData.append('image', this.file);
                if(this.changeprofile){
                  axios.post('auth/profile/update/avatar', formData, {
                      headers: {
                        'content-type': 'multipart/form-data',
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
              
                    onUploadProgress: function( progressEvent ) {
                
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
                    }.bind(this)
                })
                .then((response) => {
                  // window.location.reload()
                  console.log(this.file)
                  console.log(response.data.foto)
                  
                })

                }else{
                axios.post('auth/profile/update/cover', formData, {
                      headers: {
                        'content-type': 'multipart/form-data',
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
              
                    onUploadProgress: function( progressEvent ) {
                
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
                    }.bind(this)
                })
                .then((response) => {
                  window.location.reload()
                  
                })
                }

        }
    },
    changeProfile(){
    this.previewImage = null,
     this.changeprofile = true; 
    },
    changeCover(){
      
      this.changeprofile = false;
      this.previewImage = null;
    }

  },
  created: function(){
      this.username = this.$route.params.username
        axios.get('auth/profile/'+this.username,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
              this.user = response.data.user       
              this.user.cover = '/media/cover/'+this.user.cover
         
          

            });
  },
  computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            auth: 'auth/user'
        }),
    }
}
</script>