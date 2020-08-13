<template>
  <div class="container-fluid">
    <div class="row">
      <div class="jumbotron-fluid hero">
          <img src="https://picsum.photos/id/1005/200/200" alt="avatar" class="img-fluid rounded-circle">
      </div>
    </div>
    <div class="space"></div>
    <div class="container p-5">
      <div class="row text-center">
        <div class="col-md-6 offset-md-3">
          <h1>Steven Ujang</h1>
          <h5>1197050010</h5>
          <p class="my-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis nulla repellendus provident deserunt aspernatur. Architecto incidunt vitae quod deserunt omnis illum amet saepe sit commodi! Praesentium vero voluptatem ab nihil?</p>
          <button class="btn btn-primary btn-lg">Following</button>
          <hr>
          <ul class="list-unstyled">
            <PostPreview @click.native="redirectPost"/>
          </ul>
          <div class="d-flex justify-content-around h3">
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-heart text-danger"></i> 33</a>
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-comment"></i> 3</a>
              <a href="#" class="text-secondary text-decoration-none"><i class="fas fa-share"></i> 5</a>
              <a href="#" class="text-secondary text-decoration-none"><i class="far fa-bookmark"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.hero {
  background-image: url('https://picsum.photos/1200/1920');
  background-size: cover;
  background-position: center center;
  height: 50vh;
  width: 100%;
  position: relative;
}
.hero img {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translate(-50%, 50%);
  border: 10px solid white;
}
.space {
  margin: 8% 0px;
}
</style>

<script>
import PostPreview from '../components/PostPreview';

export default {
  components: {
    PostPreview,
  },
  methods: {
    redirectPost() {
      console.log('clicked');
      this.$router.push('/post');
    }
  }
}
</script>