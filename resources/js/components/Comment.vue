<template>
    <div>
        <div class="comment" >
            <img v-bind:src="'/media/avatar/'" alt="avatar" class="img-fluid img-post img-comment">
                <div class="single-comment">
                    <h6></h6>
                <br>
                </div>
                                   
        </div>   
        <div class="child-comment">
            <img v-bind:src="'/media/avatar/'" alt="avatar" class="img-fluid img-post img-comment">
                <div class="single-comment">
                    <h6></h6>
                <br>
                </div>           
        </div>
        
    </div>

</template>

<style scoped>
.comment p {
            display: inline;
         
        }
.comment h6 {
            font-weight: 700;
            padding: 0;
            margin: 0 0 .25rem;
}
.pointer{
    cursor: pointer;
}
.child-comment {
            padding-left: 50px;
        }
        
.single-comment{
    margin-left: 10px;
    display: inline-block;
    background: #f9f9f9;
    font-size: 13pt;
    flex-grow: 1;
    padding: 0.5em 10px;    
    border-radius: 10px;
}
.comment{
    display: flex;
    margin: 1.5em 10px;
}
.img-comment{
    height: 2.5rem;
    width: 2.5rem;
}
</style>
<script>
export default {
props:{
    post_id: Number,
},
}
</script>