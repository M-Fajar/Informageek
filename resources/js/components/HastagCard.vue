<template>
    <v-list shaped  style="min-height: 350px;">
      <v-list-item-group
        v-model="selectedItem"
        color="primary"
      > 
      <div v-if="filteredList.length == 0">
                <h3 class="text-center text-secondary">Tagar tidak ditemukan</h3>
                </div>
        <v-list-item
          v-for="(item, i) in filteredList"
          :key="i"
           @click="toHastag(item.name)"
           class="border-bottom"
            style="height:80px"
        >
          <v-list-item-icon>
            
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title class="text-h6"  v-text="'#'+item.name"></v-list-item-title>
            <v-list-item-subtitle  v-text="item.posts.length +' postingan'"></v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  
</template>
<script>
export default {

  props:{
    items:{
      default:''
    },
    keyword:{
      default:''
    }

  },
  data(){
    return{
     selectedItem: '',
    } 
  },
  computed:{
    filteredList() {
        return this.items.filter(item => {
        let resultName =  item.name.toLowerCase().includes(this.keyword.toLowerCase())
    
            return resultName
    
        })
    }
  },
   methods:{
    toHastag(name){
      this.$router.push('/hastag/'+name)
      
    }

  },
  created:function(){
    
  }

}
</script>

<style>
