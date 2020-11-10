<template>
    <div>
        <div v-for="index in 5" :key="index">
            <li class="media my-5 justify-content-between border-bottom">
                <img src="/media/frontend/sugiono.png" alt="kakek lejen" class="img-fluid">
                <div class="media-object mx-3 text-left flex-fill">
                    <h2>#AnnisaFitri</h2>
                    <p>250k</p>
                </div>
            </li>
        </div>
    </div>
</template>
