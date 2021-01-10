<template>

        <v-list shaped style="min-height: 350px;" >
            <v-list-item-group
                v-model="selectedItem"
                color="primary"
            >   
                <div v-if="filteredList.length == 0">
                <h3 class="text-center text-secondary">Akun tidak ditemukan</h3>
                </div>
                <v-list-item
                    v-for="(item,i) in filteredList"
                    :key="i"
                    @click="toProfile(item.username)"
                    class="border-bottom"
                     style="height:90px"
                >
                   
                    <v-list-item-avatar size="50">
                    <v-img  :src="'/media/avatar/'+ item.foto"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                    <v-list-item-title class="text-h6" v-text="item.name"></v-list-item-title>
                    <v-list-item-subtitle v-text="item.username"></v-list-item-subtitle>
                    </v-list-item-content>
                  

                </v-list-item>
            </v-list-item-group>
        </v-list>
      

</template>

<script>
export default {

  props:{
    users:{
      default:''
    },
    keyword:{
      default:''
    }

  },
  data(){
    return{
      selectedItem: '1',
          dialogm1: '',
    } 
  },
  computed:{
    filteredList() {
        return this.users.filter(user => {
        let resultName =  user.name.toLowerCase().includes(this.keyword.toLowerCase())
    
        if (resultName) {
            return resultName
        } else {
            return user.username.toLowerCase().includes(this.keyword.toLowerCase())
        }
        })
    }
  },
  methods:{
    toProfile(username){
      this.$router.push('/profile/'+username)
      
    }
  }

}
</script>

<style>
