<template>
  
    <v-dialog
      v-model="dialog"
      class="mx-auto mb-3"
      max-width="400px"
        
      
    >
      <v-card>
        <v-card-text style="margin-bottom:-20px;margin-top:10px" ><span class="text-h5 text-center">Buat Group</span>  
        <v-icon class="float-right"  @click="dialog = false">mdi-close</v-icon>  </v-card-text>
         <v-divider></v-divider>
        <v-text-field
            v-model="roomName"
            label="Nama Group"
            clearable
          ></v-text-field>
          <v-card-action>
              <v-btn block dark color="yellow">Buat</v-btn>
          </v-card-action>

      </v-card>
    </v-dialog>
  
</template>

<script>
export default {
    data(){
        return{
            roomName:'',
            dialog: true,
        }
        
    },watch:{
         dialog:function(){
            console.log(this.dialog)
            if(this.dialog == false){
                this.$emit('close')
            }
        },
    }
}
</script>
