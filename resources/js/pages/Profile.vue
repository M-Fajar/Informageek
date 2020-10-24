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
          <ul class="nav justify-content-center my-3">
            <li class="nav-item">
              <a class="nav-link color-dark" href="#">23 Post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link color-dark" href="#">128 Pengikut</a>
            </li>
            <li class="nav-item">
              <a class="nav-link color-dark" href="#">181 Mengikuti</a>
            </li>
          </ul>
          <hr class="border-bottom">
          <h2 class="text-center">Post</h2>
          <Timeline :post-length="2" :show-form="false" />
          <router-link  :to="{name: 'post'}" class="btn btn-light btn-lg mt-4 btnshadow rounded-pill">Lihat Selengkapnya</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.hero {
  background-image: url('/media/bg.jpg');
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
.nav-item > .nav-link {
  color: #333 !important;
}
.btnshadow{
  box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
}
</style>

<script>
import Timeline from '../components/Timeline';

export default {
  components: {
    Timeline,
  },
  methods: {
    redirectPost() {
      console.log('clicked');
      this.$router.push('/post');
    }
  }
}
</script>