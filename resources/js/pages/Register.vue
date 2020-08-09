<template>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card border-0 mx-auto card-shadow">
                <div class="card-body p-5 text-center">
                    <form method="post" @submit="checkForm" class="w-75 mx-auto">
                        <h1 class="mb-4">Register</h1>
                        <div class="form-group">
                            <input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" v-model="email" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" v-model="password" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirm" v-model="confirm" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" :class="{ }" placeholder="Confirm Password">
                        </div>
                        <button class="mt-4 btn btn-warning rounded-pill btn-block submit p-3" type="submit">Submit</button>
                        
                    </form>
                    <p v-if="errors.length" style="padding: 10px;">
                            <b>Please correct the following error(s):</b>
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                errors: [],
                username: null,
                email: null,
                password: null,
                confirm: null,
            }
        },
        methods:{
            // Mengecek form
            checkForm: function(e){
                // Array error berfungsi untuk menampung error
                this.errors = [];
                // Mengecek username
                if (!this.username) {
                    this.errors.push("Username harus diisi");
                }
                // Mengecek email
                if (!this.email) {
                    this.errors.push('Email required.');
                } else if (!this.validEmail(this.email)) {
                    this.errors.push('Email tidak Valid');
                }
                // Mengecek password
                if (!this.password){
                    this.errors.push('Password harus diisi');
                    if (this.password < 8){
                        this.errors.push('Password kurang dari 8');
                    }
                }
                else if (this.password != this.confirm){
                    this.errors.push('Password tidak sesuai');
                }
                // Jika tidak ada error
                if (!this.errors.length) {
                    return true;
                }
                e.preventDefault();
            },
            validEmail: function (email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
