<template>
	<ul class="list-group">
		<button class="list-group-item" v-for="(rm, index) in room" :key="index" v-on:click="selectRoom(rm.id)">
			<div class="row">
				<div class="col-xs-2" style="padding-right: 0; padding-left: 0">
					<a href="#"><img v-bind:src="'/media/user.jpg'" class="img-circle" alt="user image" width="50px"></a>
				</div>
				<div class="col-xs-10">
					<h5 v-if="rm.name != null">{{rm.name}}</h5>
					<h5 v-else>{{rm.user[0].name}}</h5>
					<p v-if="rm.message[0] !== undefined">{{rm.message[0].message}}</p>
				</div>
			</div>
		</button>
	</ul>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
        	room: Array,
        },
        data() {
        	return {
        		idroom: 0,
        	}
        },
        methods: {
        	selectRoom(idroom){
        		this.idroom = idroom;
        		this.$emit('selectRoom', this.idroom);
        	}
        },
        filters: {
	        ifInArray: function (value) {
	            return this.editlistAssesments.indexOf(value) > -1 ? 'Yes' : 'No';
	        }
	    },
    }
</script>
