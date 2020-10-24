<template>
	<div class="card">
		<div class="card-body">
			<div class="media">
				<img :src="avatar" class="mr-3" alt="avatar">
				<div class="media-body">
					<input type="text" class="form-control status" placeholder="Ide apa hari ini">
					<div class="mt-2">
						<ul class="list-inline h3">
							<li class="list-inline-item">
								<a href="#" class="text-secondary text-decoration-none"><i class="far fa-image"></i></a>
							</li>
							<li class="list-inline-item">
								<a href="#" class="text-secondary text-decoration-none"><i class="far fa-map"></i></a>
							</li>
							<li class="list-inline-item">
								<a href="#" class="text-secondary text-decoration-none"><i class="far fa-user"></i></a>
							</li>
							<li class="list-inline-item">
								<a href="#" class="text-secondary text-decoration-none"><i class="far fa-smile-wink"></i></a>
							</li>
							<li class="list-inline-item float-right">
								<button type="button" class="btn btn-warning rounded-pill px-4">Kirim</button>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		avatar: String,
	}
}
</script>

<style>
/*Beranda Tengah*/
.card{
    box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
    border: none;
    border-radius: 10px;
}
.status{
    background: #F9F8F8;
    border-radius: 45px;
    height: 45px;
    top: 15px;
}
</style>