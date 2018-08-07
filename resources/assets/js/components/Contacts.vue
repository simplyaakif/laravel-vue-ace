
<template lang="html">
    <div>
        <h2 class="text-center">Contact Form Messages</h2>
        <p class="text-center">Manage all your contact form queries in a blink of an eye.</p>
        <div class="br-section-wrapper">
            
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                    <input class="form-control mg-b-20" type="text" placeholder="Search for some data in here." v-model="search">
                    </div>
                    <div class="col-md-2">
                    <button class="btn btn-primary" @click="fetchData">Get Contact Forms</button>
                    </div>

                </div>
            </div>
            <div class="ht-60 mg-b-20 bd d-flex align-items-center justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-basic mg-b-0">
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                        <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Last">
                        <i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>
                    </ul>
                </nav>
            </div>
            <div class="containe">
                <div class="ro">
                    
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
            pagination: {},
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

        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
            }
            this.pageination = pagination;
        }
        
    }
    }
</script>

<style lang="scss">
</style>