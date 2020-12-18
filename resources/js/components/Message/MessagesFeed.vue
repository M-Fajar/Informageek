<template>
<div v-if="messages !=null">
        <h1>{{contact[0].name}}</h1>    
 <div class="msg_history" ref="feed">
 
        <div v-for="message in messages" :key="message.id">
            <div class="incoming_msg" v-if="message.user_id == contact[0].id">
              <div class="incoming_msg_img"> <img v-bind:src="'/media/avatar/' + contact[0].foto"  class="img-circle" alt="sunil"> </div>
              <div class="received_msg">
                <div class="received_withd_msg">
                  <p>{{message.message}}</p>
                  <span class="time_date">{{ message.created_at | chatDate}}</span></div>
              </div>
            </div>
            <div class="outgoing_msg" v-else>
              <div class="sent_msg">
                <p>{{message.message}}</p>
                <span class="time_date"> {{ message.created_at | chatDate}}</span> </div>
            </div>
          </div>
        </div>
           
                <!-- <ul class="chat"  >
                    <li class="clearfix " v-for="message in messages" :class="`${message.user_id == contact[0].id ? ' right' : ' left'}`" :key="message.id">
                    	<span class="chat-img " :class="`${message.user_id == contact[0].id ? ' pull-left' : ' pull-right'}`">
                    		<img src="https://bootdey.com/img/Content/user_3.jpg" alt="User Avatar">
                    	</span>
                    	<div class="chat-body clearfix">
                    		<div class="header">
                    			<strong class="primary-font">John Doe</strong>
                    			<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 12 mins ago</small>
                    		</div>
                    		<p>
                  			{{ message.message }}
                    		</p>
                    	</div>
                    </li>
                    <li class="right clearfix">
                    	<span class="chat-img pull-right">
                    		<img src="https://bootdey.com/img/Content/user_1.jpg" alt="User Avatar">
                    	</span>
                    	<div class="chat-body clearfix">
                    		<div class="header">
                    			<strong class="primary-font">Sarah</strong>
                    			<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> 13 mins ago</small>
                    		</div>
                    		<p>
                    			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. 
                    		</p>
                    	</div>
                    </li>
                                   
                </ul>
            -->
<div class="type_msg">
            <div class="input_msg_write">
              <input v-model="message" type="text"  @keyup.enter="send" class="write_msg" placeholder="Type a message" />
              
              <button @click="send" class="msg_send_btn" type="button"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
            </div>
</div>
</div>
</template>

<script>
    export default {
        props: {
            contact: {
                type: Array
            },
            messages: {
                type: Array,
                
            }
        },
        data() {
            return {
                message: ''
            };
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            },
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }
                console.log(this.message)
                this.$emit('send', this.message);
                this.message = '';
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>
<style lang="scss" scoped>

   
.incoming_msg_img {
  display: inline-block;
  width: 6%;
}
.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.outgoing_msg{ overflow:hidden; margin:10px 0 10
px;}
.sent_msg {
  float: right;
  width: 46%;
}
.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
}

.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border: medium none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 17px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 470px;
  overflow-y: auto;
}
    h1 {
        font-size: 18px;
        margin: 0;
        padding-bottom: 5px;
        border-bottom: 1px solid lightgray;
        
    }
</style>



