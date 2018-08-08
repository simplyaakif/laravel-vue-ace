
<template lang="html">
    <div>
        <h2 class="text-center">Contact Form Messages</h2>
        <p class="text-center">Manage all your contact form queries in a blink of an eye.</p>
        <div class="br-section-wrapper">
            
            <div class="continer">
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
                    <li class="page-item">
                        <a class="page-link" href="#" @click="fetchData(pagination.first_page_url)" aria-label="First">
                        <i class="fa fa-angle-double-left"></i>
                        </a>
                    </li>
                    <li class="page-item" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                        <a class="page-link" href="#" @click="fetchData(pagination.prev_page_url)" aria-label="Prev">
                        <i class="fa fa-angle-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" style=" min-width: 250px;margin: 0px 10px;" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                    <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]" >
                        <a class="page-link" href="#" @click="fetchData(pagination.next_page_url)" aria-label="Next">
                        <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" @click="fetchData(pagination.last_page_url)" aria-label="Last">
                        <i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>
                    </ul>
                </nav>
            </div>
            <div class="containe">
                <div class="ro">
                    
                    <table class="table table-striped ">
                        <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <!-- <th>Message</th> -->
                            <th>Status</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="(contact,n) in filterContacts" :key="contact.id">
                            <td>Q-{{contact.id}}</td>
                            <td>{{contact.contact_name}}</td>
                            <td>{{contact.contact_mobile}}</td>
                            <td>{{contact.contact_email}}</td>
                            <!-- <td>{{contact.contact_message}}</td> -->
                            <td>{{contact.contact_status}}</td>
                            <td>{{contact.created_at | moment("from", "now") }}</td>
                            <td style="font-size:18px;"><a href="#"><i class="icon ion-wrench"></i></a> <a style="margin-left:10px;" href="#" @click="deleteArticle(article.id)"><i class="icon ion-trash-b"></i></a></td>
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
        fetchData(page_url) {
            let vm = this;
            page_url = page_url || '/api/contacts';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
            this.contacts = res.data;
            vm.makePagination(res.meta, res.links);
            })
            .catch(err => console.log(err));

        },
        makePagination(meta, links) {
            let paginate = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                first_page_url: links.first,
                last_page_url: links.last,
                next_page_url: links.next,
                prev_page_url: links.prev,
            }
            this.pagination = paginate;
        },
        deleteContact(id) {
        if (confirm('Are You Sure?')) {
            fetch(`api/contacts/${id}`, {
            method: 'delete'
            })
            .then(res => res.json())
            .then(data => {
                alert('Contact Removed');
                this.fetchArticles();
            })
            .catch(err => console.log(err));
        }
        },
        
    }
    }




</script>

<style lang="scss">
</style>