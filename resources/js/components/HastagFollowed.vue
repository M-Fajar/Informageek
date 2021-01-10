<template>
     <div class="container " style="height:250px;padding-top:50px">
      <div class="row mb-5 pl-5 text "  >
            <h3 class="text-primary">#Tagar diikuti</h3>
       
       
      </div>
      <div class="row mt-5" >
            <v-btn 
                        style="margin-right:20px"   
                        
                class="ma-2"
                outlined
                color="indigo"
                :to="{name: 'hastag',params:{key:item.name}}"
            
             v-for="item in items" :key="item.id"> #{{item.name}}</v-btn>
              

      </div>

    </div>
  
</template>

<script>
export default {
    props:{
        items:null
    }

}
</script>

<style>

</style>