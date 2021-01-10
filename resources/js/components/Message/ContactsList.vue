<template>
<div class="position-relative " >
		<div class="d-block p-2 bg-white">
                        <br>
						<form>
							<input
								class="form-control form-control-lg"
								type="search"
								placeholder="Cari Pesan"
                                v-model="search"
							/>
						</form>
		</div>
					<hr />
		<div class="pl-5"  >
            <div class="contacts-list" v-if="contacts != null">

            <ul class="friend-list" >
                <li  v-for="contact in filteredList" :key="contact.id" @click="selectContact(contact)" :class="{ 'active': contact.id == selected.id }">
                	<a href="#" class="clearfix">
                		<img v-if="contact.name == null" v-bind:src="'/media/avatar/'+ contact.user[0].foto" alt="" class="img-circle">
                        <img v-else v-bind:src="'/media/frontend/group.png'" alt="" class="img-circle">
                		<div class="friend-name">	
                			<span class="font-weight-bold" v-if="contact.name != null">{{contact.name}}</span>
                            <span class="font-weight-bold" v-else>{{contact.user[0].username}}</span>
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
                           
                              <span v-if="contact.message[0] !== undefined">  {{contact.message[0].created_at | formatDate}}</span>
                           
                        </small>
        
                		<small class="chat-alert label label-danger" v-if="unreadCount[contact.id] != null">
                                                    <v-badge
                             
                        
                                :content="unreadCount[contact.id] "
                                color="green"
                                overlap
                            > </v-badge>
                        </small>
                        <span v-if="contact.message.length >0">
                            <small v-if="contact.message[0].user_id == auth.uid" class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                        </span>
      

                	</a>
                </li>
            </ul>
        </div>
                    </div>
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
        props:['contacts','previewMessage','unreadCount','changeContact'] 
        ,
        data() {
            return {
                selected: {id:0},
                search:'',
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
            },
            getCountUnread(value){
                console.log(value)
            },
            
        },
        computed: {
            filteredList() {
                this.sortLast
            return this.contacts.filter((room,i) => {
            
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
             sortLast(){
                function compare(a, b) {
                    if(!a.message.length > 0 && !b.message.length> 0){
                        return 1
                    }
                    else if(!a.message.length > 0){
                        return 1
                    }
                    else if(!b.message.length> 0){
                        return -1
                    }
                    else{
                        if (a.message[0].id < b.message[0].id)
                            return 1;
                        if (a.message[0].id > b.message[0].id)
                            return -1;
                        return 0;
                    }
                    
                    }

                return this.contacts.sort(compare);
            },
            
           
             ...mapGetters({
            authenticated: 'auth/authenticated',
            auth: 'auth/user'
        }),
        },
        mounted:function(){
               
        },
        watch:{
            contacts:function(value){
                if(this.changeContact == null){
                    
                   return 
                }
            
                else {
                    console.log('ct'+this.changeContact)
                    this.contacts.forEach(element => {
                        if(element.name == null){
                            if(element.user[0].id == this.changeContact){
                            this.selected = element
                            return
                            }
                        }
                        else{
                            if(element.name == this.changeContact){
                            this.selected = element
                            return
                            }
                        }
                        

                    });
                }
                     
       
                         

            }
                        
        }
           
                
            
        
            
        

    

    }
</script>