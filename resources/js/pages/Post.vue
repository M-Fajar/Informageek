<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div v-if="user !=null">
            <PostPreviewAuth v-if="listPost!=null" :listPost="listPost"/>
        </div>
        <div v-else>
            <PostPreview v-if="listPost!=null" :listPost="listPost"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PostPreview from '../components/PostPreview';
import { mapGetters,mapActions } from "vuex";
import PostPreviewAuth from '../components/PostPreviewAuth';
import axios from 'axios';
export default {
  components: {
    PostPreview,
    PostPreviewAuth,
  },
  data(){
    return{
      postData:null,
      listPost:null,
    }
  },

  mounted: function(){
        
        axios.get("auth/posts/"+this.$route.params.id,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {

                if(response.data.username.length == 0)
                this.$router.push('/');
                this.listPost = response.data
                
                

            });
    },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),

    
    },
  


}
</script>

<style>

</style>