<template>
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<div class="card border-0 mx-auto card-shadow">
				<div class="card-body p-5 text-center">
					<form method="post" @submit="loginCheck" class="w-75 mx-auto">
						<h1 class="mb-4">Masuk</h1>
						<div class="form-group">
							<input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="password" name="password" v-model="password" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Password">
						</div>
						<button class="mt-4 btn btn-warning rounded-pill text-dark btn-block submit p-3" type="submit">LOGIN</button>
					</form>
					<p v-if="errors.length" style="padding: 10px;">
                        <b>Tolong periksa kembali:</b>
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
				password: null,
			}
		},
		methods:{
			loginCheck: function(e){
				this.errors = [];
				if (!this.username) {
					this.errors.push("Username harus diisi");
				}
				if (!this.password){
					this.password.push("Password harus diisi");
				}

				if (!this.errors.length){
					return true;
				}
				
				e.preventDefault();
			}
		},
		mounted() {
			console.log('Component mounted.')
		}
	}
</script>
