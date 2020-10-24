<template>
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-md-3 p-3">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <div class="media">
              <i class="fas fa-filter fa-2x mr-3 text-secondary"></i>
              <div class="media-body">
                <h2>Filter</h2>
                <ul class="list-unstyled">
                  <li><a href="" class="card-link text-danger h5">Akun</a></li>
                  <li><a href="" class="card-link text-secondary h5">Filter</a></li>
                  <li><a href="" class="card-link text-secondary h5">Hashtag</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 p-3">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body p-5">
            <h1 class="card-tile">Hasil Pencarian: <small>Annisa</small></h1>
            <ul class="list-unstyled">
              <PersonCard v-for="index in 5" :key="index"/>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PersonCard from '../components/PersonCard';
export default {
  components: {
    PersonCard,
  }
}
</script>

<style>

</style>