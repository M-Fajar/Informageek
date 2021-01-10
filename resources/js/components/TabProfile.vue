<template>
  <div >
    <template>
        <v-tabs
          v-model="tab"

        >
          <v-tabs-slider color="yellow"></v-tabs-slider>

          <v-tab
            v-for="item in items"
            :key="item"
            style="width: 50% ;text-transform: none !important;"
            
          >
            {{ item }}
          </v-tab>
        </v-tabs>
      </template>

    <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
       <PostCard v-if="item=='Post' && listPost!=null" :listPost="listPost" />
        <Hastag v-if="item=='Tagar' && hastags!=null" :items="hastags" />
       
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import PostCard from '../components/PostCard';
import Hastag from '../components/HastagFollowed';
  export default {
    components:{
        PostCard,
        Hastag
    },
    data () {
      return {
        tab: null,
        listPost:null,
        items: [
          'Post', 'Tagar',
        ],
        hastags:null
       
      }
    },
    props:{
        user:{
            default:null,
        }
    },
    methods:{
        getPost(user){
            axios.get("auth/posts/user/"+user,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.listPost = response.data
                
            });
        },
        getHastag(user){
             axios.get("auth/hastag/user/"+user,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                
                this.hastags = response.data
                
            });
        }
    },
    mounted:function(){
        this.getPost(this.user)
        this.getHastag(this.user)
         
    },
    watch:{
        user(value){
            this.getPost(value)
        }
    }
    
  }
</script>