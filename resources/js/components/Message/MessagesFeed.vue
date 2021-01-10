<template>
<div v-if="messages !=null">
 
        <v-list style="margin-bottom:-20px;margin-top:-25px">
      

      <v-list-item
      >
        <v-list-item-avatar v-if="messages.user != null">
          <v-img   v-if="messages.user.length == 1"
            :src="'/media/avatar/' + messages.user[0].foto"
          ></v-img>
          <v-img v-else
          
            src="/media/frontend/group.png"
          ></v-img>
        </v-list-item-avatar>

         <h2 v-if="messages.room_name==null">{{messages.user[0].name}}</h2>   
        <h2 v-else>{{messages.room_name}}</h2>
        
      </v-list-item>
    </v-list>
  <hr>
<!-- 
            -->
      
       
 <div class="msg_history" id="feed" ref="feed">
 
        
        <div v-for="message in messages.chat" :key="message.id">
            <div class="incoming_msg mt-2" v-if="message.user_id != auth.uid">
              <div class="incoming_msg_img"> <img v-bind:src="'/media/avatar/' + message.user.foto"  alt="sunil"> </div>
              <div class="received_msg">
                  <p class="font-weight-normal pl-1" style="margin-bottom:-3px;">{{message.user.name}}</p>
                <div class="received_withd_msg">

                  <p class="shadow">{{message.message}}</p>
                  <span class="time_date">{{ message.created_at | chatDate}}</span></div>
              </div>
            </div>
            <div class="outgoing_msg mt-2" v-else>
              <div class="sent_msg rounded ">
                <p class="shadow">{{message.message}}</p>
                <span class="time_date"> {{ message.created_at | chatDate}}
                  <v-icon v-if="message.read == 0" small>mdi-check</v-icon>
                  <v-icon v-else small color="primary">mdi-check</v-icon>
                  </span> </div>
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
            	<!-- <form class="d-flex">
							<input
								class="form-control form-control-lg flex-grow-1 mr-2"
								type="search"
								placeholder="Search"
							/>
							<button class="btn btn-primary">Kirim</button>
						</form> -->
            <div class="input_msg_write">
            
						
              <input v-model="message" type="text"  @keyup.enter="send" class="write_msg form-control" placeholder="Tulis Pesan" />
              
              <button @click="send" class="msg_send_btn" type="button"><v-icon x-large color="yellow" dark>mdi-send-circle</v-icon></button>
            </div>
</div>
</div>
</template>

<script>
import { mapGetters,mapActions } from "vuex"
    export default {
        props: ['messages','scroll'],
        data() {
            return {
                message: '',
                
            };
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight + 1000;
                
                },50);
            },
             scrollToEnd() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight + 1000;
                
                },1300);
            },
            send(e) {
                this.scrollToEnd();
                e.preventDefault();
                
                if (this.message == '') {
                    return;
                }
                   
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
            },
            scroll(scroll){
               this.scrollToBottom();
            }
           
        },
        computed:{
              ...mapGetters({
            authenticated: 'auth/authenticated',
            auth: 'auth/user'
            }
              )
        }
    }
</script>
<style lang="scss" scoped>

   



.incoming_msg_img {
  display: inline-block;
  width: 6%;
  max-width: 40px;
  padding-top: 10px;
}

.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
 }
 .received_withd_msg p {
  background: #F7CA18 none repeat scroll 0 0;
   border-radius: 10px;
  min-height: 20px;
  font-size: 16px;
  margin: 0; color:white;
  padding: 5px 10px 5px 12px;
  width:100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 3px 2px 0;
}
.received_withd_msg { width: 57%;}
.mesgs {
  float: left;
  padding: 30px 15px 0 25px;
  width: 100%;
}

 .sent_msg p {
  background: #94C2ED none repeat scroll 0 0;
  border-radius: 10px;
  min-height: 20px;
  font-size: 16px;
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
 
  border: medium none;
 
 
  cursor: pointer;
 
 
  position: absolute;
  right: 5px;
  top: 7px;
 
}
.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 440px;
  overflow-y: auto;
}
  
</style>



