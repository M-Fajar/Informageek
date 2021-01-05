  <template>
  <div class="container-fluid">
    <v-overlay :value="overlay">
      <v-progress-circular
        indeterminate
        size="64"
      ></v-progress-circular>
    </v-overlay>
    <div class="row">
      
      
      <div class="jumbotron-fluid hero" >
        <v-img

          max-height="50vh"
          max-width="100%"
          :src="user.cover"
          ></v-img>
          <div v-if="user['username']== auth.username">
            <div class="edit-cover" data-toggle="modal" data-target="#orangeModalSubscription" @click="changeCover">
                <img class="camera" src="/media/frontend/camera.png" alt="">   
                <span id="upcover" >Edit Cover</span>

            </div>
          </div>    
          <div class="fotoprofil">
            <v-img id="foto" v-bind:src="'/media/profile/'+ user.foto" alt="avatar" class="img-fluid rounded-circle" @click="changeProfile">
            </v-img>
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
        <div class="col-md-8 offset-md-2">
          <h1>{{user['name']}}</h1>
          <h5>{{user['username']}}</h5>
          <p class="my-4">{{user['bio']}}</p>



        <!-- //Setting   Profil-->
          <div v-if="user['username']== auth.username && user != null">
            
          
            
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          v-bind="attrs"
          v-on="on"
          @click="showEdit()"
        >
          Edit Profile
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Edit Profile</span>
        </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
              
              
                <v-col cols="12">
                  <v-text-field
                    label="Nama"
                    v-model="userEdit['name']"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="Username"
                    v-model="userEdit['username']"
                    :rules="usernameRule"
                    :counter="12"
                    :error-messages="errors['editUsername']"
                   
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="Bio"
                    v-model="userEdit['bio']"
                  ></v-text-field>
                </v-col>
             
             
        
            
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Tutup
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="updateProfile()"
          >
            Simpan
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  
              
      
         </div>   
               

        <!-- Follow Button -->
         <div v-if="user['username'] != auth.username && user['username'] != null">

           <v-btn v-if="followed == false" color="primary" @click="follow()">Ikuti</v-btn>
            <div v-if="followed == true">

                   <v-btn class="btn btn-light"> Kirim Pesan</v-btn>
                  <v-btn class="btn btn-light"  @click.stop="dialog = true">
                  <i class="fa fa-user-check"></i>                  </v-btn>
                  
                  <v-dialog v-model="dialog" max-width="350"
                  >
                    <v-card>
                      <v-card-title>
                        Berhenti Mengikuti @{{user.username}} ?
                      </v-card-title>

                      <v-card-actions>
                        <v-btn class="text-transform-none"
                          color="green darken-1"
                          text
                          @click="dialog = false"
                        >
                          Batal
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="red darken-1"
                          text
                          @click="follow()"
                          
                        >
                          Berhenti mengikuti
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
            </div>

            

            </div>
          <br>
            <div>
              <span class="count">{{user.post}} Post </span>
              <span class="hrbatas"></span>
           
              <span class="count" @click="showFollowers()">{{user.follower}} Pengikut </span>
              <span class="hrbatas"></span>
           
              <span class="count" @click="showFollowing()">{{user.following}} Mengikuti </span>
              <ListUser v-if="openList" :title="titleDialog" :items="listUser"  @close="openList = false"/>
            </div>

          <hr>
          
          
        
        </div>
      </div>
       <div class="row" style="margin-top:-40px">
        <div class="col-md-8 offset-md-2">
          <TabProfile v-if="username!=null" :user="username" />
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
    
    <div class="text-center">
      <v-btn
        
        color="blue-grey"
        class="ma-2 white--text"
        :loading="isSelecting"
        @click="onUploadClick"
    > Upload
      <v-icon dark right>
        mdi-cloud-upload
      </v-icon>
    </v-btn>
      <input type="file" class="d-none" name="file" ref="fileInput"  @input="pickFile"/>
    </div>

  </div>
       </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <v-btn
              color="warning"
              
              @click="simpan()" 
              data-dismiss="modal"
              :disabled="enableBtn"
            >
              Simpan
            </v-btn>
        
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

</style>

<script>
import { mapGetters,mapActions } from "vuex"
import axios from 'axios'
import TabProfile from '../components/TabProfile';
import router from '../router'
import auth from '../store/auth';
import ListUser from '../components/ListUser';
export default {
  components: {
    TabProfile,
    ListUser
  },
  data(){
    return{
      items: {},
      listUser:[],
      dialog:false,
      titleDialog:'',
      errors:[],
      user:[],
      previewImage: null,
      file:'',
      followed : Boolean,
      changeprofile: true, //cek button edit apa yang di klik
      isSelecting: false,
      userEdit:{},
      username:null,
      overlay: false,
      openList:false,
      usernameRule: [
        
        v => v.length <= 12 || 'Username tidak lebih dari 12 karakter',
      ],
    }
  },
  methods: {
     showFollowing(){
       this.titleDialog = "Mengikuti"
       this.listUser = this.items['Following']
       this.openList = true
     },
     showFollowers(){
       this.titleDialog = "Pengikut"
       this.listUser = this.items['Followers']
       this.openList = true
     },
    onUploadClick() {
      this.isSelecting = true
      window.addEventListener('focus', () => {
        this.isSelecting = false
      }, { once: true })

      this.$refs.fileInput.click()
    },
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
          this.overlay = true
          let formData = new FormData();
                formData.append('image', this.file);
                if(this.changeprofile){
                  axios.post('auth/profile/update/avatar', formData, {
                      headers: {
                        'content-type': 'multipart/form-data',
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
              
                })
                .then((response) => {
                  window.location.reload()    
                  
                  
                })

                }else{
                axios.post('auth/profile/update/cover', formData, {
                      headers: {
                        'content-type': 'multipart/form-data',
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
                  
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
    },
    follow(){
      this.followed = !this.followed
      Vue.set(this.user,'follower',this.followed == true ? this.user['follower']+1 : this.user['follower']-1)
      axios.post('auth/user/follow',{
        user: this.user['username']
      },
      {
         headers: {
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
      }).then(response => {
        console.log(response.data)
      } )
      this.dialog = false
      
    },
    showEdit(){
        this.userEdit['username'] = this.user['username']
        this.userEdit['name'] = this.user['name']
        this.userEdit['bio'] = this.user['bio']
    },
    updateProfile(){
     if( this.userEdit['username'] == this.user['username'] &&
        this.userEdit['name'] == this.user['name'] &&
        this.userEdit['bio'] == this.user['bio'] ){
          this.dialog = false
          return 
        }
      console.log(this.userEdit)
      axios.post('auth/profile/update',this.userEdit,
       {
         headers: {
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
      }).then((response) => {
          
          
          this.dialog = false
          if(this.userEdit['username'] ==  this.user['username']){
            this.getDataUser(this.username)
          }
          else{
            this.$router.push({ name: 'profile' ,params:{username:this.userEdit['username']}})
                 window.location.reload()    
          }
          
          
      }).catch(error => {
        Vue.set(this.errors,'editUsername',error.response.data.error);
   
      })
      
    },
    getDataUser(username){
       axios.get('auth/user/checkfollow/'+username,{
           headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
        }).then(response=> {
          this.followed = response.data
         
        })
        //get data user profil
           axios.get('auth/profile/'+username,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
              this.user = response.data.user       
              this.user.cover = '/media/cover/'+this.user.cover
              
              

            }) 
      },
      getDataFollow(username){
        axios.get('auth/user/following/'+username,
       {
         headers: {
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
      }).then((response) => {
          this.items['Following'] = response.data.following
       
          
      })
      axios.get('auth/user/follower/'+username,
       {
         headers: {
                         Authorization: 'Bearer ' + this.$store.state.auth.token  
                    },
      }).then((response) => {
          
          this.items['Followers'] = response.data.follower
            console.log(this.items)
      })
      }

  },
  created: function(){
      this.username = this.$route.params.username
      //cehck condition follow
      this.getDataUser(this.username)


  },mounted:function(){

      this.getDataFollow(this.username)
  },


  watch:{
    
      overlay (val) {
        val && setTimeout(() => {
          this.overlay = false
        }, 7000)
      },
      $route(to, from) {
        console.log(from)
        if(from.name == "profile"){
         this.username = to.params.username
          this.getDataUser(this.username)
          this.getDataFollow(this.username)
          
        }
    },
    followed(value){
      this.getDataFollow(this.username)
    },
        
  },
  computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            auth: 'auth/user'
        }),
        enableBtn() {
        console.log('btn');
        if(this.previewImage == null)
          return true
        return false
			},
      

        
    }
    

}
</script>