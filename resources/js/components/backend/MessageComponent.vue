<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<a :href="url+'/message/room/create'" class="btn btn-primary">
									<h4><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Message</h4>
								</a>
							</div>
							<div class="card-body">
                                <room :room="this.room" @selectRoom="getMessage($event)"></room>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<chat :key="this.currentRoom" :idroom="this.currentRoom" :user="this.user"></chat>
					</div>
				</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
        	url: String,
            user: Object
        },
        data() {
        	return {
                'currentRoom': 0,
                'room': [],
                'openmodal': false
        	}
        },
        created() {
            this.fetchRoom();
        },
        methods: {
            fetchRoom() {
                axios.get('message/room').then(response => {
                    this.room = response.data;
                })
            },
            getMessage(room) {
                this.currentRoom = room;
            }
        }
    }
</script>
