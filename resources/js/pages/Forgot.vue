<template>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card border-0 mx-auto card-shadow">
                <div class="card-body p-5 text-center">
                    <form method="post" @submit.prevent="sendForgot" class="w-75 mx-auto">
                        <h1 class="mb-4">Lupa Sandi</h1>
                        <div class="form-group">
                            <input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Username">
                            <span v-if="errors.username" class="text-danger">{{ errors.username }}</span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" v-model="email" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Email">
                            <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                        </div>
                        <button :disabled="!enableBtn" class="mt-4 btn btn-warning rounded-pill text-dark btn-block submit p-3" data-toggle="modal" data-target="#confirmModal" type="submit">Submit</button>
                    </form>
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
                username: '',
                email: '',
                modalConfirm: false,
            }
        },
        computed: {
            enableBtn() {
                return this.validateEmail(this.email) && this.validateUsername(this.username);
            }
        },
        watch:{
            username(value) {
                this.username = value;
                this.validateUsername(value);
            },
			email(value) {
				this.email = value;
				this.validateEmail(value);
			},
        },
        methods:{
            validateEmail(value) {
				if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
					this.errors['email'] = '';
					return true;
				} else if (!value.length) {
					this.errors['email'] = 'Email harus diisi';
				} else {
					this.errors['email'] = 'Email tidak valid';
				}
				return false;
			},
			validateUsername(value) {
                let diff = 6 - value.length;
				if (!value.length) {
					this.errors['username'] = 'Username harus diisi';
					return false;
				}else if (value.length < 6)  {
					this.errors['username'] = 'Username > 6 karakter ' + diff + ' tersisa';
					return false;
				} else {
					this.errors['username'] = '';
					return true;
				}
            },
            sendForgot() {
                console.log("Submit Forgot");
                this.modalConfirm = true;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
