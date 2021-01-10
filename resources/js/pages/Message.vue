<template>
    <div>
		<div class="d-flex flex-fill vh-100">
			<div class="p-2 overflow-auto group d-flex flex-column shadow-sm">
            <v-card>
                <v-navigation-drawer
                    permanent
                    expand-on-hover
                    width="500px"
                >   
                    <v-list nav dense
                    > 
                    <v-list-item class="mt-1">
                        <v-list-item-icon>
                        <v-icon>mdi-magnify</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title><v-text-field
                                label="Cari"
                                placeholder="Cari User"
                                solo
                                
                                v-model="searchUser"
                            ></v-text-field></v-list-item-title>
                    </v-list-item>
  
                    <v-list-item    >
                        <v-list-item-icon>
                            <v-icon >
                                mdi-plus-thick
                            </v-icon>
                        
                        </v-list-item-icon>

                        
                        <v-list-item-title><button :disabled="!enableBtn" @click="newRoom()" class="btn btn-warning text-dark btn-block submit p-3" type="submit" >Buat Pesan</button>
                            <!-- <v-btn  block color="yellow" :disabled="!enableBtn" dark>Kirim Pesan</v-btn> -->
                             </v-list-item-title>
                    </v-list-item>

                    </v-list>
                   
                    

                    <v-divider></v-divider>
                    
                    <v-list
                    nav
                    dense
                    v-if="following !=null"
                    >
                    <v-list-item v-for="item in filteredList" :key="item.id" >
                         
                        <v-list-item-avatar style="margin-left:-9px" >
                        <v-img :src="'/media/avatar/'+ item.foto"></v-img>
                        </v-list-item-avatar>
                        <v-list-item-content class="pointer"  @click="userRoom(item.id)">
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                            <v-list-item-subtitle v-text="item.username"></v-list-item-subtitle>
                        </v-list-item-content>
                        <v-list-item-action>
                             <input class="pointer" type="checkbox" v-model="selectedUser" v-bind:value="item.id" />
                        </v-list-item-action>
                        
                    </v-list-item>
                   
                    </v-list>
                </v-navigation-drawer>
                </v-card>
                        </div>
			<div class="overflow-auto people">
				
                          <ContactsList v-if="contacts != null" :contacts="contacts" :changeContact="changeContact" :previewMessage="previewMessage" :unreadCount="unreadCount" @selected="startConversationWith"/>
                
			</div>
            
        
			<div class="overflow-auto flex-fill chat shadow-sm">
                <Conversation :scroll="scroll" :messages="messages" @new="saveNewMessage"/>
				<!-- <div class="d-flex flex-column">
					<div class="px-2 py-2 bg-white">
						<h1>{{messages.room_name}}</h1>
					</div>
					<ul class="list-unstyled px-3 py-2 flex-fill">
						<li class="my-3" >
						
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
				</div> -->
		
            </div>
		</div>
        <div>
         <v-dialog
      v-model="dialogNewRoom"
      
      max-width="400px"
        
      
    >
      <v-card>
        <v-card-text style="margin-bottom:-20px;margin-top:10px;padding-top:10px" ><span class="text-h5 text-center">Buat Group</span>  
        <v-icon class="float-right"  @click="dialogNewRoom = false">mdi-close</v-icon>  </v-card-text>
         <v-divider></v-divider>
         <v-card-text>
            <v-text-field
            v-model="roomName"
            label="Nama Group"
            ></v-text-field>
        </v-card-text>
       
              <v-btn  block dark :disabled="!enableCreate" @click="createRoom()" color="yellow">Buat</v-btn>
       
        
        

      </v-card>
    </v-dialog>
    </div>
        
	</div>

    
    <!-- <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-md-4 bg-white ">
            <ContactsList :contacts="contacts" :previewMessage="previewMessage" :unreadCount="unreadCount" @selected="startConversationWith"/>
            </div>
            <div class="col-md-8 bg-white ">
            <Conversation  :messages="messages" @new="saveNewMessage"/>
            </div>
            
        </div>
    </div> -->
</template>

<script>
    import Conversation from '../components/Message/Conversation';
    import ContactsList from '../components/Message/ContactsList';
    import NewRoom from '../components/NewRoom';
    import { mapGetters,mapActions } from "vuex"
    import axios from 'axios';
    export default {
      
        data() {
            return {
                selectedContact: null,
                selectedUser:[],
                messages: {},
                contacts: null,
                previewMessage:{},
                unreadCount:{},
                previewTime:{},
                disabled:true,
                following:null,
                searchUser:'',
                dialogNewRoom:false,
                 roomName:null,
                 changeContact:false,
                 scroll:0
                 
            
            };
        },
        mounted() {
             
            Echo.private(`messages.${this.user.uid}`)
                .listen('NewMessage', (e) => {
                     this.hanleIncoming(e.message);
                });
            this.fetchMessage()
            
            this.getListFollowing()
         
            if(this.$route.params.userTo){
                 axios.get('auth/user/checkfollow/'+this.$route.params.userTo,{
                    headers:     {
                        Authorization: 'Bearer ' + this.$store.state.auth.token
                        }
                    }).then(response=> {
                        console.log(response.data)
                        if(response.data.status == true){
                            this.userRoom(response.data.id)
                        }
         
                })
        
            }
        },
        methods: {
            fetchMessage(){
                axios.get('auth/message/room',{
                headers: {
                
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
              
                }
            })
                .then((response) => {
                   
                    this.contacts = response.data;
                    this.unreadCount= {}
                    this.contacts.forEach(room => {
                        room['message'].forEach(element => {
                            if (element['read'] == 0 && element['user_id'] != this.user['uid']) {
                                Vue.set(this.unreadCount,room['id'],(this.unreadCount[room['id']]==null ? 1 : this.unreadCount[room['id']]+=1))    
                                console.log(this.unreadCount[room['id']])
                            }
                            
                        });
                        
                    });
                
                });
            },
            
            startConversationWith(contact) {
                this.updateUnreadCount(contact['id'], true);
                
                axios.get(`auth/message/chat/${contact.id}`,{
                headers: {
                  
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
              
                }
            })
                    .then((response) => {
                        this.messages = response.data;
                        console.log(this.messages)
                        this.selectedContact = contact;
                        this.selectedUser=[]
                    })
            },
            saveNewMessage(message) {
                
                this.scroll +=1
                this.messages['chat'].push(message);
                   this.fetchMessage()  
                   this.changeContact = false
                    Vue.set(this.previewMessage,message['room_id'],message['message']) 
                


            },
            hanleIncoming(message) {
                    this.fetchMessage()
                   this.changeContact = false
                if (this.selectedContact && message.room_id == this.selectedContact.id) {
                    axios.get('auth/message/setread/'+message['id'],{
                    headers: {
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
                    }})
                    this.saveNewMessage(message);
                    return
                }

                else{
                     
                    Vue.set(this.previewMessage,message['room_id'],message['message']) 
                  
                }
                   
                
            },
            updateUnreadCount(contact, reset) {
    
    
                    if (reset)
                        Vue.set(this.unreadCount,contact,null) 
                    else
                        Vue.set(this.unreadCount,contact,this.unreadCount[contact]+=1) 


                
            },
            getListFollowing(){
                 axios.get('auth/user/following',  {
                headers: {
                    Authorization: 'Bearer ' +this.$store.state.auth.token
                }
            }).then(response => {
                this.following = response.data.following
            })
            },
            userRoom(id){
                this.selectedUser =[]
                this.selectedUser[0] = id
                 this.changeContact = this.selectedUser[0]
                this.createRoom()
            },
            newRoom(){
                if(this.selectedUser.length > 1){
                    this.dialogNewRoom = true
                    
                }
                else{
                     this.changeContact = this.selectedUser[0]
                     this.roomName = null
                    this.createRoom()
                   
                }
            },
            createRoom(){
             
                axios.post('auth/message/room/store',{
                    user: this.selectedUser,
                    roomName:this.roomName
                },{
                    headers:{
                         Authorization: 'Bearer ' + this.$store.state.auth.token
                    }
                }).then(response =>{
                    if(this.roomName != null){
                        this.changeContact = this.roomName
                        this.roomName = null    
                    }
            
                    this.contacts = response.data
                    this.dialogNewRoom = false
                    if(this.selectedUser.length==1){
                       
                        this.contacts.forEach(element => {
                            
                            if(element.user[0].id == this.selectedUser[0] && element.name == null){
                                 this.startConversationWith(element)         
                            }
                        });
                    }else{
                         console.log('masuk')
                        this.startConversationWith(this.contacts[0])
                    }
                    
                   

                    
                })
            }
        },
        computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        }),
         filteredList() {
        return this.following.filter(item => {
        let resultName =  item.name.toLowerCase().includes(this.searchUser.toLowerCase())
    
        if (resultName) {
            return resultName
        } else {
            return item.username.toLowerCase().includes(this.searchUser.toLowerCase())
        }
        })
        },
        	enableBtn() {
				console.log('btn');
				return this.selectedUser.length > 0
            },
            enableCreate() {
				if(this.roomName == null){
                    return false
                }
                else {
                    return this.roomName.length > 0
                }
				
			}

     },
        components: {Conversation, ContactsList,NewRoom},
      
      
    }
</script>
<style scoped>

.people {
width: 300px;
}
.chat {
	width: 62%;
}
</style>



