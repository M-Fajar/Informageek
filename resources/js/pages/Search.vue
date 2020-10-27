<template>
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-md-3 p-3">
        <a href="#" class="text-decoration-none text-secondary h3">
          <i class="fas fa-filter mr-2"></i>
          Filter
        </a>
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