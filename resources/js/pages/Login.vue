 <template>
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<div class="card border-0 mx-auto card-shadow">
				<div class="card-body p-5 text-center">
					<form method="post" @submit.prevent="submit" class="w-75 mx-auto">
						
						
						<h1 class="mb-4">Masuk</h1>
						
						<div class="form-group">
							<input type="text" name="username" v-model="username" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Username">
							<span v-if="errors.username" class="text-danger">{{ errors.username }}</span>
						</div>
						<div class="form-group">
							<input type="password" name="password" v-model="password" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Password">
							<span v-if="err" class="text-danger">{{ err }}</span>
							<span v-if="errors.password" class="text-danger">{{ errors.password }}</span>
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
						LOGIN
						</v-btn>
						<!-- <button :disabled="!enableBtn"  type="submit" >LOGIN</button> -->
						
					</form>
			
				</div>
			</div>
		</div>
		
	</div>
</template>

<script>
import { mapActions } from 'vuex'
import router from '../router'
	export default {
		name: 'login',
		data(){
			return{
				username: '',
				password: '',
				errors: [],
				err: null,
				 loader: null,
        		loading: false,
				
			}
		},
		computed: {
			enableBtn() {
				console.log('btn');
				return this.validate(this.password);
			}
		},
		watch: {
			username(value) {
				this.username = value;
				this.validate(value);
				this.err = null
			},
			password(value) {
				this.password = value;
				this.validate(value);
				this.err = null
			},
			loader () {
        		const l = this.loader
        		this[l] = !this[l]

        		setTimeout(() => (this[l] = false), 3000)

        		this.loader = null
	  	},
			

		},
		methods:{
			...mapActions({
				logIn: 'auth/logIn'
			}),
			

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
		}
	}
</script>
