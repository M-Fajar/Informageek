<template>
    <div class="contacts-list" v-if="contacts != null">

            <ul class="friend-list">
                <li  v-for="contact in filteredList" :key="contact.id" @click="selectContact(contact)" :class="{ 'active': contact == selected }">
                	<a href="#" class="clearfix">
                		<img v-bind:src="'/media/avatar/'+ contact.user[0].foto" alt="" class="img-circle">
                		<div class="friend-name">	
                			<strong v-if="contact.username != null">{{contact.username}}</strong>
                            <strong v-else>{{contact.user[0].username}}</strong>
                		</div>
                		<div class="last-message text-muted">
                            <span v-if="previewMessage[contact.id] == null">
                                <p v-if="contact.message[0] !== undefined">{{contact.message[0].message}}</p>
                            </span>
                            <span v-else>
                                <p>{{previewMessage[contact.id]}}</p>
                            </span>
                        </div>
                		<small class="time text-muted">
                            <span v-if="previewMessage[ contact.id] == null">
                                {{contact.message[0].created_at | formatDate}}
                            </span>
                            <span v-else>
                                Baru saja
                            </span>
                        </small>
        
                		<small class="chat-alert label label-danger" v-if="unreadCount[contact.id] != null">{{unreadCount[contact.id]}}</small>
                        <small v-if="contact.message[0].user_id == auth.uid" class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
      

                	</a>
                </li>
            </ul>
        </div>
        <!-- <ul><li>
            <input type="text" class="form-control" v-model="search" placeholder="Cari Pesan"/></li>
            <li v-for="contact in filteredList" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                <div class="avatar">
                    <img :src="contact.profile_image" >
                </div>
                <div class="contact">
                    
                    <h5 v-if="contact.name != null">{{contact.name}}</h5>
				    <h5 v-else>{{contact.user[0].name}}</h5>
                    <span style="display: inline;" class="email">@{{ contact.user[0].username }}</span>
                    
                    <p v-if="contact.message[0] !== undefined">{{contact.message[0].message}}</p>
                    <span v-if="previewMessage[contact.id] == null">
                        <p v-if="contact.message[0] !== undefined">{{contact.message[0].message}}</p>
                    </span>
                    <span v-else>
                        <p>{{previewMessage[contact.id]}}</p>
                    </span>
                    

                </div>
                <span class="unread" v-if="unreadCount[contact.id] != null">{{unreadCount[contact.id]}}</span>
            </li>
        </ul> -->
   
</template>

<script>
import { mapGetters,mapActions } from "vuex"
    export default {
        props: {
            contacts: {
                type: Array,
                default: null
            },
            previewMessage: {
                type: Object,
                default:null
                },
            unreadCount:{
                type:Object,
                default:null
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
                search:'',
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            },
            getCountUnread(){}
        },
        computed: {
            filteredList() {
            return this.contacts.filter(room => {
                if(room.name == null) {
                    return room.user[0].username.toLowerCase().includes(this.search.toLowerCase())}
                else {
                  return  room.name.toLowerCase().includes(this.search.toLowerCase())}
                
                
            })
            },
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            },
             ...mapGetters({
            authenticated: 'auth/authenticated',
            auth: 'auth/user'
        }),
        },

    

    }
</script>