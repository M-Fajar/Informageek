<template>
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card border-0 mx-auto card-shadow">
                <div class="card-body p-5 text-center">
                  
                    <form method="post" @submit.prevent="sendRegister" class="w-75 mx-auto">
                        <h1 class="mb-4">Register</h1>
                        <div class="form-group">
                            <input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Username">
                            <span v-if="errors.username || postE" class="text-danger">{{ errors.username }}</span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" v-model="name" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Nama">
                            <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" v-model="email" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Email">
                            <span v-if="errors.email || postE" class="text-danger">{{ errors.email }}</span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" v-model="password" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" placeholder="Password">
                            <span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
                        </div>
                        <div class="form-group">
                            <input type="password" :disabled="enableConfirm" name="confirm" v-model="confirm" class="form-control form-control-lg rounded-pill bg-dark px-3 py-2 text-light text-center" :class="{ }" placeholder="Confirm Password">
                            <span v-if="errors.confirm" class="text-danger">{{ errors.confirm }}</span>
                        </div>
                        <v-btn
						class="mt-4 btn rounded-pill btn-block submit p-3 font-weight-bold"
						:loading="loading"
						color="yellow"
						type="submit"
						large
						:disabled="!enableBtn"
						@click="loader = 'loading'"
						>
						DAFTAR
						</v-btn>
                        <!-- <button :disabled="!enableBtn" class="mt-4 btn btn-warning rounded-pill btn-block submit p-3" type="submit">Submit</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
import axios from 'axios';
    export default {
        data(){
            return{
                errors: [],
                username: '',
                email: '',
                name:'',
                password: '',
                confirm: '',
                postE: false,
                 loader: null,
        		loading: false,
				
            }
        },
        computed: {
            enableConfirm() {
                
                return !this.password.length;
            },
            enableBtn() {
                return this.validateEmail(this.email) && this.validateUsername(this.username) && this.validatePassword(this.password) && this.validateConfirm() && this.validateName(this.name);
            }
        },
        watch: {
            name(value){
                this.name = value
                this.validateName(value)
            },
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
            loader () {
        		const l = this.loader
        		this[l] = !this[l]

        		setTimeout(() => (this[l] = false), 3000)

        		this.loader = null}
		},
        methods:{
            ...mapActions({
				logIn: 'auth/logIn'
			}),
            validateUsername(value) {
                let diff = 3 - value.length;
                if (!value.length) {
                    this.errors['username'] = 'Username harus diisi';
                    return false;
                }else if (value.length < 3)  {
                    this.errors['username'] = 'Minimal 3 karakter ' + diff + ' tersisa';
                    return false;
                } else if(value.length > 12){
                    this.errors['username'] = 'Maksimal 12 karakter ';
                    return false
                }
                else {
                    this.errors['username'] = null;
                    return true;
                }
            },
            validateName(value) {
                if (!value.length) {
                    this.errors['name'] = 'Nama harus diisi';
                    return false;
                }
                else if(value.length > 30){
                    this.errors['name'] = 'Maksimal 20 karakter ';
                    return false
                }
                else {
                    this.errors['name'] = null;
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
				let diff = 6     - value.length;
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
               
                if (this.confirm != this.password) {
                    this.errors['confirm'] = 'Konfirmasi harus sama';
                    return false;
                } else {
                    this.errors['confirm'] = '';
                    return true;
                }
            },
            sendRegister(){ 
                this.postE = false;
               axios.post('auth/register',{
                    username: this.username,
                    email: this.email,
                    name: this.name,
                    password: this.password
                }).then((response) => {
                   
                    console.log(this.username)
                    this.submit()
                }).catch(error => {
                    
                if( error.response.data.errors['username']){
                this.errors['username'] = 'Username sudah digunakan';}
                if(error.response.data.errors['email']){
                this.errors['email'] = 'Email sudah terdaftar'}
                this.postE = true
                this.loading = false
                
                });
                
            },
            submit(){
				let  data = {
					username: this.username,
					password: this.password
				};
				this.logIn(data).then(()=>{
					this.$router.replace({
						name: 'beranda'
					})
				}).catch((error) => {
					this.err = 'username atau password tidak sesuai'
					this.loading = false
					}
				)
			
			}
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
