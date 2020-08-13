<template>
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<div class="card border-0 mx-auto card-shadow">
				<div class="card-body p-5 text-center">
					<form method="post" @submit.prevent="redirect" class="w-75 mx-auto">
						<h1 class="mb-4">Masuk</h1>
						<div class="form-group">
							<input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Username">
							<span v-if="errors.username" class="text-danger">{{ errors.username }}</span>
						</div>
						<div class="form-group">
							<input type="password" name="password" v-model="password" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Password">
							<span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
						</div>
						<router-link :to="{name : 'beranda'}">
						<button :disabled="!enableBtn" class="mt-4 btn btn-warning rounded-pill text-dark btn-block submit p-3" type="submit" >LOGIN</button>
						</router-link>
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
				username: '',
				password: '',
				errors: [],
				
			}
		},
		computed: {
			enableBtn() {
				console.log('btn');
				return this.validate(this.username) && this.validate(this.password);
			}
		},
		watch: {
			username(value) {
				this.username = value;
				this.validate(value);
			},
			password(value) {
				this.password = value;
				this.validate(value);
			},
		},
		methods:{
			validate(value) {
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
			redirect() {
				console.log("Form submitted");
				this.$router.push('/beranda');
			}
		},
		mounted() {
			console.log('Component mounted.')
		}
	}
</script>
