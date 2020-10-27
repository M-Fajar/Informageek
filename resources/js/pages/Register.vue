<template>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card border-0 mx-auto card-shadow">
                <div class="card-body p-5 text-center">
                    <form method="post" @submit.prevent="checkForm" class="w-75 mx-auto">
                        <h1 class="mb-4">Register</h1>
                        <div class="form-group">
                            <input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Username">
                            <span v-if="errors.username" class="text-danger">{{ errors.username }}</span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" v-model="email" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Email">
                            <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" v-model="password" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Password">
                            <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                        </div>
                        <div class="form-group">
                            <input type="password" :disabled="enableConfirm" name="confirm" v-model="confirm" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" :class="{ }" placeholder="Confirm Password">
                            <span v-if="errors.confirm" class="text-danger">{{ errors.confirm }}</span>
                        </div>
                        <button :disabled="!enableBtn" class="mt-4 btn btn-warning rounded-pill btn-block submit p-3" type="submit">Submit</button>
                    </form>
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
                password: '',
                confirm: ''
            }
        },
        computed: {
            enableConfirm() {
                console.log(!this.password.length);
                return !this.password.length;
            },
            enableBtn() {
                return this.validateEmail(this.email) && this.validateUsername(this.username) && this.validatePassword(this.password) && this.validateConfirm();
            }
        },
        watch: {
            username(value) {
                this.username = value;
                this.validateUsername(value);
            },
			email(value) {
				this.email = value;
				this.validateEmail(value);
			},
			password(value) {
				this.password = value;
				this.validatePassword(value);
			},
			confirm(value) {
                this.confirm = value;
                this.validateConfirm();
			},
		},
        methods:{
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
			validatePassword(value) {
				let diff = 6 - value.length;
				if (!value.length) {
					this.errors['password'] = 'Password harus diisi';
					return false;
				}else if (value.length < 6)  {
					this.errors['password'] = 'Password > 6 karakter ' + diff + ' tersisa';
					return false;
				} else {
					this.errors['password'] = '';
					return true;
				}
            },
            validateConfirm() {
                console.log(this.confirm + " = " + this.password);
                if (this.confirm != this.password) {
                    this.errors['confirm'] = 'Konfirmasi harus sama';
                    return false;
                } else {
                    this.errors['confirm'] = '';
                    return true;
                }
            },
            sendRegister: function(e){
                console.log("Submit register");
            },
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
