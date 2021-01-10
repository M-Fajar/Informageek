<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 p-3">
      </div>
      <div class="col-md-8">
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
        <div class="card border-0 shadow-sm rounded">
          
          
          
        <div class="card-body" >
        <v-tabs-items v-model="tab">
          <v-tab-item
            v-for="item in items"
            :key="item"
          >
            
            
         
              <PersonCard v-if="item == 'Akun' && users != null && key!=null" :users="users" :keyword="key"/>
              <HastagCard v-if="item == 'Tagar' && hastag != null && key!=null" :items="hastag" :keyword="key"/>
              

         
          </v-tab-item>

        </v-tabs-items>
        
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import router from '../router'
import PersonCard from '../components/PersonCard';
import HastagCard from '../components/HastagCard';
export default {
  components: {
    PersonCard,
    HastagCard
  },
  data(){
    return{
      users:null,
      hastag:null,
      key: null,
       items: [
          'Akun', 'Tagar',
        ],
      tab: null,
    }
  },
  methods:{
    getUserData(){
      axios.get('auth/user/all', {
                headers: {
                     
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
              
                }
            }).then(response =>{
        this.users = response.data
        console.log(this.users)
      })
    },

    getHastagData(){
      axios.get('auth/hastag/all',{
                headers: {
                     
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
              
                }
            }).then(response =>{
        this.hastag = response.data
        console.log(this.hastag)
      })
    }
  },
  mounted:function(){
    this.getUserData()
    this.getHastagData()
    
  },
  created:function(){
      this.key =  this.$route.params.key
  },
   watch:{
    $route(to, from) {
        this.key = to.params.key
    },
    
  
  }
  
}
</script>

<style>

</style> 