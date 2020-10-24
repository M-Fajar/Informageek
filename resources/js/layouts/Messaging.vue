<template>
	<div class="vh-100 d-flex flex-column" id="wrap">
		<NavbarHome />
		<slot />
	</div>
</template>

<style scoped>
body {
	min-height: 100vh !important;
	overflow: hidden;
}
</style>

<script>
import NavbarHome from "../components/NavbarHome";

export default {
	components: {
		NavbarHome,
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