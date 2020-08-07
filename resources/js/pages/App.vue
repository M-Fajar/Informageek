<template>
  <div class="container d-flex flex-column justify-content-between vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent flex-md-row-reverse border-bottom">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <a @click.prevent="" class="navbar-brand logo" href="#">INFORMAGEEK</a>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <router-link class="nav-link" :to="{name: 'home'}">Selamat Datang</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'login'}">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'register'}">Register</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'forgot'}">Forgot Password</router-link>
          </li>
        </ul>
      </div>
    </nav>

    <div>
      <router-view></router-view>
    </div>
    
    <footer>
        <div class="d-flex justify-content-between">
            <p><i>Copyright Informageek 2020</i></p>
            <p><i>Teknik Informatika UIN Bandung</i></p>
        </div>
    </footer>
  </div>
</template>

<style>
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