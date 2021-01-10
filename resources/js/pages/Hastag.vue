<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
           <div class="card">
                <div class="card-body">
                 
                        <div class="row">
                            <div class="col-4 offset-md-2">
                    
                            <v-img
                            lazy-src="/media/frontend/hastag.png"
                            height="200"
                            width="200"
                            src="/media/frontend/hastag.png"
                            ></v-img>
                            </div>
                            <div class="col-6" v-if="postPopular!=null">
                            <h2>#{{key}}</h2>
                            <div @click="follow()">
                             <v-btn v-if="followed==false" width="160px" color="primary">
                                Ikuti</v-btn>
                             <v-btn v-if="followed== true" width="160px" color="">
                                Megikuti</v-btn>
                            </div>
                            <h5 class="mt-5">{{postLast.posts.length}} Post</h5>
                            </div>
                      
                            </div>
                        <br>
                        <hr>
                          <template>
            <v-tabs
              v-model="tab"
              grow
              style="margin-top:-16px"
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
                   
                    <PostCard v-if="item=='Terbaru' && postLast!=null" :listPost="postLast" />
                    <PostCard v-if="item=='Populer' && postPopular!=null" :listPost="postPopular" />
                    
                    </v-tab-item>

                </v-tabs-items> 
            </div>
           </div>
        </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import PostCard from '../components/PostCard'
export default {
  components:{
    PostCard
  },
    data(){
        return{
              followed:null,
              key: null,
              items: [
                  'Terbaru', 'Populer'
                ],
              tab: null,
             postLast:null,
             postPopular:null
                }
                
        

    },
    methods:{
        follow(){
            this.followed = !this.followed
           axios.get("auth/hastag/follow/"+this.key,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
            });
        },
        getDataLast(){
          axios.get("auth/hastag/posts/last/"+this.key,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                this.postLast= response.data[0]
                

            });
        },
        getDataPopular(){
          axios.get("auth/hastag/posts/popular/"+this.key,
            {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                this.postPopular= response.data[0]
                
                

            });
        },
      

    },
    mounted:function(){
       this.getDataLast()
     this.getDataPopular() 
    
    }
    ,created:function(){
      this.key = this.$route.params.key.toLowerCase();
      axios.get('auth/hastag/cek/'+this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
              this.followed = response.data
            });

      
    }
}
</script> 
