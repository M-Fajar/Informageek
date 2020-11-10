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
                                <li><a href="" class="card-link text-secondary h5" :class="{ 'text-danger' : ispersonActive }" @click.prevent="personActive()">Akun</a></li>
                                <li><a href="" class="card-link text-secondary h5" :class="{ 'text-danger' : ishashtagActive }" @click.prevent="hashtagActive()">Hashtag</a></li>
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
                        <PersonCard v-for="index in 5" :key="index" v-show="ispersonActive"/>
                        <HashtagCard v-show="ishashtagActive"/>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import PersonCard from '../components/PersonCard';
import HashtagCard from '../components/HashtagCard'
export default {
    data() {
        return{
            ispersonActive: true,
            ishashtagActive: false
        }
    },
    components: {
        PersonCard,
        HashtagCard
    },
    methods: {
        personActive(){
            this.ispersonActive = true
            this.ishashtagActive = false
        },
        hashtagActive(){
            this.ishashtagActive = true
            this.ispersonActive = false
        }
    }
}
</script>

<style>

</style>
