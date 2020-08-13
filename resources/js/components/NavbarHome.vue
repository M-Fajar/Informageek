<template>    
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent border-bottom">
        <a class="navbar-brand pl-2">
            <i class="fas fa-circle text-warning fa-2x"></i>
        </a>
        <h2 class="pl-3">Informageek</h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <div class="form-inline ml-auto pr-0 mr-0">
                <input class="form-control form-control-lg" type="search" placeholder="Search">
            </div>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <!-- <i class="far fa-user-circle fa-2x"></i> -->
                        <img src="/media/frontend/sugiono.png" class="img-fluid" alt="avatar" width="30px;">
                    </a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">
                        <i class="far fa-envelope fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">
                        <i class="far fa-bell fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item pl-3">
                    <a class="nav-link" href="#">
                        <!-- <i class="fas fa-cog fa-2x"></i> -->
                        <span class="fa-stack">
                            <i class="fas fa-circle fa-stack-2x text-warning"></i>
                            <i class="fas fa-cog fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</template>

<style scoped>
    /* .navbar{
        box-shadow: 4px 4px 5px rgba(0, 0, 0.25, 0.25);
    } */
    .navbar .collapse input{
        width: 700px;
        background: #F9F8F8;
        border-radius: 45px;
        text-decoration-style: none;
    }
</style>