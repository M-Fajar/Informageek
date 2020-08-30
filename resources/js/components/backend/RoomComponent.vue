<template>
	<ul class="list-group">
		<li class="list-group-item">
			<div class="row">
				<div class="col-xs-2">
					<a href="#"><img v-bind:src="'/media/user.jpg'" class="img-circle" alt="user image" width="50px"></a>
				</div>
				<div class="col-xs-10">
					<a href="#" class="text-black">
						<h5>User</h5>
						<p>Message... </p>
					</a>
				</div>
			</div>
		</li>
	</ul>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
