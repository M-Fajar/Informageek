<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <PostPreview/>
        <div class="d-flex justify-content-around h3">
            <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-heart text-danger"></i> 33</a>
            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-comment"></i> 3</a>
            <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-share"></i> 5</a>
            <a href="#" class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a>
        </div>
        <hr class="my-5">
        <ul class="list-unstyled">
          <PostPreview v-for="index in 5" :key="index"/>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import PostPreview from '../components/PostPreview';
export default {
  components: {
    PostPreview,
  },
}
</script>

<style>

</style>