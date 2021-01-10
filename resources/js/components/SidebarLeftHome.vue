<template>
  <div class="pb-2 b-right h-100">
    <p class="pop-tag pl-4 mt-4">Tagar Populer</p>
    <ol type="1" class="pt-0 mt-0">
        <li  v-for="(item) in items.slice(0, 5)" :key="item.id">
           <router-link :to="{name: 'hastag',params:{key:item.name}}">
             <h6>  #{{item.name}}</h6>  
           </router-link>
        </li>
        
    </ol>
  </div>
</template>

<script>
import axios from 'axios'
export default {
    data(){
        return{
            items:null
        }
    },

    created:function(){
        axios.get('auth/hastag/trending', {
                headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token
                }
            })
            .then(response => {
                    this.items = response.data
            })
    }


}
</script>

<style scoped>
/*Sidebar Kiri*/
.b-right{
    background-color: #fff;
    box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
}
.b-right .pop-tag{
    font-size: 25px;
    font-weight:50px;
}
</style>