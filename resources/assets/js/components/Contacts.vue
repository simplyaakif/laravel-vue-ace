
<template lang="html">
    <div>
        <h2 class="text-center">Contact Form Messages</h2>
        <p class="text-center">Manage all your contact form queries in a blink of an eye.</p>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                <input class="form-control mg-b-20" type="text" placeholder="Search for some data in here." v-model="search">
                </div>
                <div class="col-md-2">
                <button class="btn btn-primary" @click="fetchData">Get Contact Forms</button>
                </div>

                </div>
            <div class="row">
                <table class="table table-striped table-dark">
                    <tr v-for="(contact,n) in filterContacts" :key="contact.id">
                        <td>{{n+1}}</td>
                        <td>{{contact.contact_name}}</td>
                        <td>{{contact.contact_mobile}}</td>
                        <td>{{contact.contact_email}}</td>
                        <td>{{contact.contact_message}}</td>
                        <td>{{contact.contact_status}}</td>
                        <td>{{contact.created_at}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
            data(){
        return{
            contact: {
                contact_name: '',
                contact_message: ''
            },
            search: '',
            flag: false,
            contacts: [],
        };
    },

    computed:{
        filterContacts: function(){
            return this.contacts.filter((contact)=>{
                return contact.contact_name.match(new RegExp(this.search, "i")) || contact.contact_message.match(new RegExp(this.search, "i"))
            });
        }
    },

    created() {
    this.fetchData();
    },


    methods: {
        fetchData: function() {

            this.$http.get('http://127.0.0.1:8000/api/contacts')
                .then(response => {
                    return response.json();
                })
                .then (data => {
                console.log(data);
                this.contacts = data.data;
                });

        }
        
    }
    }
</script>

<style lang="scss">
</style>