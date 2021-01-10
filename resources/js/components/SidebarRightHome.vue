<template>
    <div class="shadow">
        <h4 class="pl-3 pt-2">Populer Terkini</h4>
        <div class="border-0 rounded shadow ml-3 mr-3 position-relative">
            <PostPreview v-if="post!=null" :listPost="post" />
        </div>
        <div class="p-3 mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Mengikuti</h5>
                <input type="text" class="form-control form-control-sm w-50 rounded-pill" placeholder="Cari" style="background-color: #F9F8F8;" v-model="search">
            </div>
            <div class="list-unstyled mt-2 list-following" v-if="items!=null">
                <v-list shaped>
                        <v-list-item-group
                            color="primary"
                        >
                            <v-list-item
                                v-for="item in filteredList"
                                :key="item.name"
                                
                        
                            >
                                
                                <v-list-item-avatar @click="redirectUser(item.username)" >
                                <v-img :src="'/media/avatar/'+ item.foto"></v-img>
                                </v-list-item-avatar>
                                <v-list-item-content @click="redirectUser(item.username)">
                                <v-list-item-title v-text="item.username"></v-list-item-title>
                                </v-list-item-content>
                                <v-list-item-action @click="kirimPesan(item.username)">
                                      <v-icon color='amber'>
                                        mdi-message-outline
                                    </v-icon>
                                </v-list-item-action>
                                

                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                <!-- <li class="media align-items-center"  v-for="item in filteredList" :key="item.name" >
                    <img :src="'/media/avatar/'+item.foto" class="img-fluid">
                    <div class="media-object mx-3 flex-fill" @click="redirectUser(item.username)">
                            {{item.username}}
                    </div>
                    <div class="p-3 pointer" @click="kirimPesan(item.username)">
                        <v-icon color='grey'>
                            mdi-message-outline
                        </v-icon>
                    </div>
                </li> -->
              
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import PostPreview from '../components/PostTrending'
export default {
    components:{
        PostPreview
    },
    data(){
        return{
            items:null,
            search:'',
            post:[],
        }
    },
    created:function(){
        axios.get('auth/user/following',  {
                headers: {
                    Authorization: 'Bearer ' +this.$store.state.auth.token
                }
            }).then(response => {
                this.items = response.data.following
                console.log(response.data)
            })
        axios.get('auth/posts/trending/today',  {
                headers: {
                    Authorization: 'Bearer ' +this.$store.state.auth.token
                }
            }).then(response => {
                this.post = response.data
                console.log(this.post)
            })

    },
    mounted:function(){
        
    }
    ,computed:{
         filteredList() {
        return this.items.filter(item => {
        let resultName =  item.name.toLowerCase().includes(this.search.toLowerCase())
    
        if (resultName) {
            return resultName
        } else {
            return item.username.toLowerCase().includes(this.search.toLowerCase())
        }
        })
        }
    },
    methods:{
        kirimPesan(username){
        this.$router.push('/message/'+username);
      },
       redirectUser(username){
        this.$router.push('/profile/'+username);
      }
    }

}
</script>

<style scoped>
/*Beranda Kanan*/
.bg-fadded{
    position: absolute;
    background: rgba(196, 196, 196, 0.5);
    width: 100%;
    top: 0;
    transform: translate(0, 115%);
}
.list-following{
        height: 250px;
        
    margin-top: 20px;
    
    overflow-y:scroll;
    -webkit-overflow-scrolling: touch;
}

</style>
