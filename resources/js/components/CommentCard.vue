<template>
  <div class="card">
      <div class="card-body">
          <div class="media position-relative">
              <img src="/media/frontend/sugiono.png" class="mr-3" alt="avatar">
              <div class="media-object">
                  <h5 class="mt-0"><b>{{ name }}</b></h5>
                  <p v-html="text"></p>
                  <a href="" class="position-absolute" style="top:0; right: 0;"><i class="fas fa-ellipsis-h fa-lg"></i></a>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
	props: {
    name: String,
    text: String,
  }
}
</script>

<style scoped>
.card {
  border: none;
}
</style>