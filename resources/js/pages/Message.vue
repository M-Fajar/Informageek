<template>
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-md-4 bg-white ">
            <ContactsList :contacts="contacts" :previewMessage="previewMessage" :unreadCount="unreadCount" @selected="startConversationWith"/>
            </div>
            <div class="col-md-8 bg-white ">
            <Conversation  :messages="messages" @new="saveNewMessage"/>
            </div>
            
        </div>
    </div>
</template>

<script>
    import Conversation from '../components/Message/Conversation';
    import ContactsList from '../components/Message/ContactsList';
    import { mapGetters,mapActions } from "vuex"
    import axios from 'axios';
    export default {
       
        data() {
            return {
                selectedContact: null,
                messages: {},
                contacts: [],
                previewMessage:{},
                unreadCount:{},
                previewTime:{}
            
            };
        },
        mounted() {
             
            Echo.private(`messages.${this.user.uid}`)
                .listen('NewMessage', (e) => {
                     this.hanleIncoming(e.message);
                });
          
            axios.get('auth/message/room',{
                headers: {
                
                    Authorization: 'Bearer ' + this.$store.state.auth.token,
              
                }
            })
                .then((response) => {
                   
                    this.contacts = response.data;
                     console.log(this.contacts)
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
        methods: {
            
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
                    })
            },
            saveNewMessage(message) {
                
            
                this.messages['chat'].push(message);
                Vue.set(this.previewMessage,message['room_id'],message['message']) 
                console.log(this.previewMessage)


            },
            hanleIncoming(message) {
                console.log(message)
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
                    this.updateUnreadCount(message['room_id'], false);
                }
                
            },
            updateUnreadCount(contact, reset) {
    
    
                    if (reset)
                        Vue.set(this.unreadCount,contact,null) 
                    else
                        Vue.set(this.unreadCount,contact,this.unreadCount[contact]+=1) 


                
            }
        },
        computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        }),
     },
        components: {Conversation, ContactsList}
    }
</script>




