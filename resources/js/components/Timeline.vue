<template>
  <div class="timeline">
      <ul class="list-unstyled">
          <li v-for="index in postLength" :key="index" class="my-3">
              <PostPreview @click.native="redirectPost" :show-image="index%2==0" :show-form="showForm"/>
          </li>
      </ul>
  </div>
</template>

<script>
import PostPreview from '../components/PostPreview';
export default {
  components: {
    PostPreview
  },
  props: {
    postLength: Number,
    showImage: Boolean,
    showForm: Boolean
  },
  methods: {
      redirectPost() {
          console.log('clicked');
          this.$router.push('/post');
      }
  },
}
</script>

<style>

</style>