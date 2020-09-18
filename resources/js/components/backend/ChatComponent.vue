<template>
            <div class="panel panel-default" v-if="idroom != 0">
                <div class="panel-header">
                    <div class="row">
                        <div class="col-xs-1">
                            <a href="#"><img v-bind:src="'/media/user.jpg'" class="img-circle" alt="user image" width="50px"></a>
                        </div>
                        <div class="col-xs-10 align-middle">
                            <a href="#" class="h5">{{ room_name }}</a>
                        </div>
                        <div class="col-xs-1">
                            <a href="#"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="panel-body" style="min-height: 20vh">
                    <ul class="message" style="max-height: 70vh;overflow-y: scroll;">
                        <li class="message-list" v-for="(m, index) in messages" :key="index">
                            <div v-if="m.user.name == user.name" class="message-own">{{ m.message }}</div>
                            <div v-else>{{ m.message }}</div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Text message..." aria-describedby="send"
                        @keyup.enter="sendMessage"
                        v-model="newMessage">
                        <span class="input-group-addon" id="send">
                            <button class="btn" style="padding: 0 0" v-on:click="sendMessage">
                                <span class="glyphicon glyphicon-send"></span> Send
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div v-else class="panel" style="min-height: 40vh;">
                <div class="panel-body text-center">
                    No Message Selected
                </div>
             </div>
</template>

<script>
    export default {
        props: {
            idroom: Number,
            user: Object,
        },
        data () {
            return {
                'messages': [],
                'newMessage': '',
                'room_user': [],
                'room_name': ''
            }
        },
        created() {
            this.fetchMessage(this.idroom);
            Echo.join('room.'+this.idroom)
                .here((user) => {
                    console.log(user)
                })
                .joining((user) => {
                    console.log(user)
                })
                .listen('MessageSent', (event) => {
                    this.messages.push(event.message);
                });
        },
        methods: {
            fetchMessage(idroom) {
                axios.get('message/chat/'+idroom).then(
                    response => {
                        this.messages = response.data.chat;
                        this.room_user = response.data.user;
                        this.room_name = response.data.room_name;
                    }
                )
                this.idroom = idroom;
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('message/send', {
                    message: this.newMessage,
                    room: this.idroom
                });

                this.newMessage = '';
            },
            getUser(room_user) {
                if(room_user.length > 1) {
                    return 0;
                } else
                    return room_user[0].name;
            }
        }
    }
</script>
