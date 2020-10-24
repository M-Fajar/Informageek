<template>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <PostCard :show-image="true"/>
        <hr class="my-5">
        <ul class="list-unstyled">
          <li class="my-3" v-for="comment in comments" :key="comment.id" >
            <CommentCard :name="comment.name" :text="comment.text" />
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import CommentCard from '../components/CommentCard';
import PostCard from '../components/PostCard';
export default {
  data() {
    return {
      comments: [
        {
          id: 1,
          name: "Ujang Alex",
          text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun..",
        },
        {
          id: 2,
          name: "Michael Ncep",
          text: "<a href='#'>@ujang.alex</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud",
        },
        {
          id: 3,
          name: "ِAgnez",
          text: "<a href='#'>@ujang.alex</a> Lorem ipsum.",
        },
        {
          id: 4,
          name: "Martin Sukaesih",
          text: "<a href='#'>@agnez</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud",
        },
      ],
    }
  },
  components: {
    CommentCard,
    PostCard,
  },
}
</script>

<style>

</style>