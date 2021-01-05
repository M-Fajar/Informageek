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
        
       
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import PostCard from '../components/PostCard';
  export default {
    components:{
        PostCard
    },
    data () {
      return {
        tab: null,
        listPost:null,
        items: [
          'Post', 'Hastag',
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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
                
                console.log(this.listPost)

            });
        }
    },
    mounted:function(){
        this.getPost(this.user)
         
    },
    watch:{
        user(value){
            this.getPost(value)
        }
    }
    
  }
</script>