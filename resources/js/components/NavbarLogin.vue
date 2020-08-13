<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent flex-md-row-reverse border-bottom">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <router-link :to="{name: 'beranda'}" class="navbar-brand logo" @click.prevent="">
        INFORMAGEEK
      </router-link>
      

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'beranda'}">Selamat Datang</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'login'}">Masuk</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'register'}">Daftar</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'forgot'}">Lupa Sandi</router-link>
          </li>
        </ul>
      </div>
    </nav>
</template>

<style scoped>
.navbar-light .navbar-brand {
    color: #FEDE2B;
}
.logo{
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-style: italic;
    font-weight: bold;
    font-size: 40px;
    line-height: 60px;
    /* identical to box height */

    text-align: center;

    color: #FEDE2B;
    padding: 0;
    margin: 0;
}
li{
  font-size: 18px;
  margin-right: 20px;
}
</style>