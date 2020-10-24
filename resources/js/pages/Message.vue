<template>
	<div>
		<div class="d-flex flex-fill vh-100">
			<div class="p-2 overflow-auto group d-flex flex-column shadow">
				<div class="d-block text-center">
					<img
						src="/media/frontend/sugiono.png"
						class="img-fluid m-2"
						alt="avatar"
					/>
				</div>
				<div class="d-block text-center">
					<img
						src="/media/frontend/sugiono.png"
						class="img-fluid m-2"
						alt="avatar"
					/>
				</div>
				<div class="d-block text-center">
					<img
						src="/media/frontend/sugiono.png"
						class="img-fluid m-2"
						alt="avatar"
					/>
				</div>
				<div class="d-block text-center">
					<img
						src="/media/frontend/sugiono.png"
						class="img-fluid m-2"
						alt="avatar"
					/>
				</div>
				<div class="d-block text-center">
					<img
						src="/media/frontend/sugiono.png"
						class="img-fluid m-2"
						alt="avatar"
					/>
				</div>
			</div>
			<div class="overflow-auto people">
				<div class="position-relative">
					<div class="d-block sticky-top p-2">
						<form>
							<input
								class="form-control form-control-lg"
								type="search"
								placeholder="Search"
							/>
						</form>
					</div>
					<hr />
					<ul class="list-unstyled p-2">
						<li class="my-3" v-for="comment in comments" :key="comment.id">
							<CommentCard :name="comment.name" :text="comment.text" />
						</li>
					</ul>
				</div>
			</div>
			<div class="overflow-auto flex-fill chat">
				<div class="d-flex flex-column">
					<div class="px-3 py-2 sticky-top bg-white">
						<h1>Percakapan</h1>
					</div>
					<ul class="list-unstyled px-3 py-2 flex-fill">
						<li class="my-3" v-for="comment in comments" :key="comment.id">
							<CommentCard :name="comment.name" :text="comment.text" />
						</li>
					</ul>
					<div class="d-block text-center px-3 py-2">
						<form class="d-flex">
							<input
								class="form-control form-control-lg flex-grow-1 mr-2"
								type="search"
								placeholder="Search"
							/>
							<button class="btn btn-primary">Kirim</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
.group {
	width: 8%;
}
.people {
	width: 30%;
	background-color: #e5e5e5;
}
.chat {
	width: 62%;
}
</style>

<script>
import CommentCard from "../components/CommentCard";
export default {
	components: {
		CommentCard,
	},
	data() {
		return {
			comments: [
				{
					id: 1,
					name: "Ujang Alex",
					text:
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun..",
				},
				{
					id: 2,
					name: "Michael Ncep",
					text:
						"<a href='#'>@ujang.alex</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud",
				},
				{
					id: 3,
					name: "ِAgnez",
					text: "<a href='#'>@ujang.alex</a> Lorem ipsum.",
				},
				{
					id: 4,
					name: "Martin Sukaesih",
					text:
						"<a href='#'>@agnez</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididun ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud",
				},
			],
		};
	},
};
</script>

<style scoped>
/* .container-fluid {
	overflow: hidden;
	margin: 0 !important;
	padding: 0 !important;
} */
.messagelist {
	background-color: #e5e5e5;
}
</style>