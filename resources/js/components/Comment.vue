<template>
    <div >
        <div v-for="item in commentData" :key="item.id">
        <div class="comment parrent-comment" >
            <img v-bind:src="'/media/avatar/'+ item.user.foto" alt="avatar" class="img-fluid img-circle img-comment">
                <div class="single-comment">
                    <h6>{{item.user.username}}</h6>
                <p>{{item.comment}}</p>
                </div>
                                   
        </div> 
        
        <div class="comment child-comment" v-for="child in item.child" :key="child.id">
            <img v-bind:src="'/media/avatar/'+child.user.foto" alt="avatar" class="img-fluid img-circle">
                <div class="single-comment">
                    <h6>{{child.user.username}}</h6>
                <p>{{child.comment}}</p>
                </div>           
        </div>
        </div>
        
    </div>

</template>

<style scoped>

</style>
<script>
import axios from 'axios';
export default {
props:{
    post_id: Number,
},
data(){
    return{
        commentData:{}
    }
},

created:function(){
    axios.get("auth/posts/comment/"+this.post_id,{
        headers:{
            Authorization: 'Bearer ' + this.$store.state.auth.token
        }
    }).then(response => {
        this.commentData = response.data.comments
        console.log(this.commentData)
    })
}

}
</script>