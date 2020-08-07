<template>
	<div class="row">
		<div class="offset-md-3 col-md-6">
			<div class="card border-0 mx-auto card-shadow">
				<div class="card-body p-5 text-center">
					<form action="" class="w-75 mx-auto">
						<h1 class="mb-4">Login</h1>
						<div class="form-group">
							<input type="text" name="username" id="username" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Username">
						</div>
						<div class="form-group">
							<input type="text" name="password" id="password" class="form-control form-control-lg rounded-pill bg-dark text-light text-center" placeholder="Password">
						</div>
						<button class="mt-4 btn btn-warning rounded-pill text-dark btn-block submit p-3" type="submit">LOGIN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	mounted() {
		console.log('Component mounted.')
	}
}
</script>
