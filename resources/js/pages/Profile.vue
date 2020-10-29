  <template>
  <div class="container-fluid">
    <div class="row">
         
      <div class="jumbotron-fluid hero">
      <a href="">  <div class="cover-foto">
          <div class="content-cover">
          <img class="camera" src="/media/frontend/cam.png" alt="">          
          
          <span>Edit Cover Photo</span>  
          </div>
        </div></a>
          
          <img id="foto" v-bind:src="'/media/profile_full/' + user['foto']" alt="avatar" class="img-fluid rounded-circle">
          <img id="edit-pen" src="/media/frontend/pencil.png" alt="">
      </div>
    </div>
    <div class="space"></div>
    <div class="container p-5">
      <div class="row text-center">
        <div class="col-md-6 offset-md-3">
          <h1>{{user['name']}}</h1>
          <h5>{{user['username']}}</h5>
          <p class="my-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis nulla repellendus provident deserunt aspernatur. Architecto incidunt vitae quod deserunt omnis illum amet saepe sit commodi! Praesentium vero voluptatem ab nihil?</p>
          
          <div v-if="user['username']== auth.username">
            <div class="dropdown">
              <button class="btn btn-primary btn-lg dropbtn">Edit Profil</button>
              <div class="dropdown-content">
              <a href="#" class="" data-toggle="modal" data-target="#modalLoginForm">Upload Foto Profile</a>  
              <a href="#">Cover Profile</a>
              </div>
            </div>
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
  </div>
</template>

<style scoped>

.cover-foto{
  background:rgba(211,211,211, 0.5);
  width: 150px;
  padding-top: 3px; 
  height: 32px;
  bottom: 10%;
  left: 10%;
  margin: auto;
  border-radius: 8%;
  position: absolute;
   transform: translate(-50%, 50%);
}

.cover-foto span{
  color: #f1f1f1;
  font-weight: bold;
  
}
#edit-pen{
  position: absolute;
  bottom: 10%;
  left: 60%;
  transform: translate(-50%, 50%);
  border: 0px solid white;
  width: 50px;
}


.hero {
  background-image: url('https://picsum.photos/1200/1920');
  background-size: cover;
  background-position: center center;
  height: 50vh;
  width: 100%;
  position: relative;
}
#foto{
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translate(-50%, 50%);
  border: 10px solid white;
}
.space {
  margin: 8% 0px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  border-radius: 15%;
  font-size: 8pt;
  background-color: #f9f9f9;
  min-width: 110px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}


.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: darkblue;
}
</style>

<script>
import { mapGetters,mapActions } from "vuex"
import PostPreview from '../components/PostPreview';
import router from '../router'
export default {
  components: {
    PostPreview,
  },
  data(){
    return{
      user:[]
    }
  },
  methods: {
    redirectPost() {
      console.log('clicked');
      this.$router.push('/post');
    }
  },
  created: function(){
      this.username = this.$route.params.username
       axios.get("http://localhost:8000/api/auth/profile/"+this.username,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
              this.user = response.data.user       
                console.log(this.user)
          

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