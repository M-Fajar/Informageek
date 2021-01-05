<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      scrollable
      class="mx-auto"
      max-width="400px"
      tile
      
    >
      <v-card>
        <v-card-text style="margin-bottom:-20px;margin-top:10px" ><span class="text-h5 text-center">{{title}}</span>  
        <v-icon class="float-right"  @click="dialog = false">mdi-close</v-icon>  </v-card-text>
         <v-divider></v-divider>
    
      <v-text-field
        label="Cari"
        v-model="search"
        prepend-icon="mdi-magnify"
        style="margin-right:25px;margin-top:-18px;margin-bottom:-10px;margin-left:7px"
      ></v-text-field>
   
        <v-list shaped style="height: 300px;">
            <v-list-item-group
                v-model="selectedItem"
                color="primary"
            >
                <v-list-item
                    v-for="item in filteredList"
                    :key="item.name"
                    :to= "{name: 'profile',params: {username:item.username}}"
                    @click="dialog = false"
                >
                  
                    <v-list-item-avatar>
                    <v-img :src="'/media/avatar/'+ item.foto"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                    <v-list-item-title v-text="item.name"></v-list-item-title>
                    <v-list-item-subtitle v-text="item.username"></v-list-item-subtitle>
                    </v-list-item-content>
                  

                </v-list-item>
            </v-list-item-group>
        </v-list>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>

import router from '../router'
  export default {
    data () {
      return {
          dialog:true,
          search:'',
          selectedItem: Number,
          dialogm1: '',
          
      }
    },
    props:{
        items:{
            default:[]
        },
        title:{
            type:String
        }
    },
    created(){
      
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

    },
    watch:{
        dialog:function(){
            console.log(this.dialog)
            if(this.dialog == false){
                this.$emit('close')
            }
        },

        items(value){
            console.log(value)          
        }
    },
    

    
  }
</script>