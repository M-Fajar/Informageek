<template>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card border-0 mx-auto card-shadow">
                <div class="card-body p-5 text-center">
                    <form method="post" @submit="sendEmail" class="w-75 mx-auto">
                        <h1 class="mb-4">Lupa Sandi</h1>
                        <div class="form-group">
                            <input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" v-model="email" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Email">
                        </div>
                        <button class="mt-4 btn btn-warning rounded-pill text-dark btn-block submit p-3" data-toggle="modal" data-target="#confirmModal" type="submit">Submit</button>
                    </form>
                    <p v-if="errors.length" style="padding: 10px;">
                        <b>Tolong periksa kembali:</b>
                        <ul>
                            <li v-for="error in errors" :key="error">{{ error }}</li>
                        </ul>
                    </p>
                    <!-- Modal -->
                    <div v-if="modalConfirm" class="modal fade" id="confirmModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded">
                                <div class="modal-body" style="padding: 50px;">
                                    <p style="font-size: 24px; text-align: center;">Kata sandi baru telah dikirim melalui email anda!</p>
                                    <button type="button" class="mt-4 btn btn-warning rounded-pill text-dark btn-block submit p-3" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
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
                modalConfirm: false,
            }
        },
        methods:{
            sendEmail:function(e){
                this.errors = [];
                if (!this.username){
                    this.errors.push("Username harus diisi");
                }
                if (!this.email) {
                    this.errors.push("Email harus diisi");
                } else if (!this.validEmail(this.email)) {
                    this.errors.push('Email tidak Valid');
                }

                if (this.errors.length){
                    this.modalConfirm = false
                }

                if (!this.errors.length){
                    this.modalConfirm = true;
                    this.errors = []
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
        }
    }
</script>
