<template>
	<div id="app">
		<component :is="layout">
			<router-view />
		</component>
	</div>
</template>

<script>
const default_layout = "default";
const home_layout = "home";
const messaging_layout = "messaging";

export default {
	computed: {
		layout() {
			// switch (this.$route.meta.layout) {
			// 	case home_layout:
			// 		return home_layout + "-layout";
			// 		break;
			// 	case messaging_layout:
			// 		return messaging_layout + "-layout";
			// 		break;
			// 	default:
			// 		return default_layout + "-layout";
			// 		break;
			// }
			return (this.$route.meta.layout || default_layout) + "-layout";
		},
	},
};
</script>

<style>
/* The emerging W3C standard
   that is currently Firefox-only */
* {
	scrollbar-width: thin;
	scrollbar-color: grey white;
}

/* Works on Chrome/Edge/Safari */
*::-webkit-scrollbar {
	width: 12px;
}
*::-webkit-scrollbar-track {
	background: white;
}
*::-webkit-scrollbar-thumb {
	background-color: grey;
	border-radius: 20px;
	border: 3px solid white;
}
</style>