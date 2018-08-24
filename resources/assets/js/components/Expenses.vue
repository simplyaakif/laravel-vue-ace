<template lang="html">
    <div> 
        <h2 class="text-center">Expenses</h2>
        <p class="text-center">Manage all your contact form queries in a blink of an eye.</p>
        <div class="br-section-wrapper">
            
            

            <div class="continer" v-show="!editMode">
                    <button class="btn btn-primary mg-b-8" @click="newContact()">New Contact</button>
                <div class="row">
                    <div class="col-md-12">
                    
                    </div>
                </div>
            </div>

            <div class="row" v-show="editMode">
                <div class="col-md-12">
                    <form @submit.prevent="addContact" class="mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Contact Name" v-model="contact.contact_name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Contact Email" v-model="contact.contact_email">
                        </div>
                        <div class="form-group">
                            <input type="text" v-mask="'####-#######'" class="form-control" placeholder="Contact Mobile i.e 0300-0000000" v-model="contact.contact_mobile">
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" data-placeholder="Choose Browser" v-model="contact.status">
                                <option value="" disabled>Select Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Contact Message" v-model="contact.contact_message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark ">Save</button>
                        <button @click="goBack()" class="btn btn-light">Go Back</button>
                    </form>
                </div>
            </div>

            <div v-show="!editMode">
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
                        <input class="form-control mg-b-20" type="text" placeholder="Search for some data in here." v-model="search">
                    <table class="table table-striped ">
                        <tr>
                            <th>Sr. No</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <!-- <th>Message</th> -->
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        <tr v-for="(contact,n) in filterContacts" :key="contact.id">
                            <td>Q-{{contact.id}}</td>
                            <td>{{contact.contact_name}}</td>
                            <td>{{contact.contact_mobile}}</td>
                            <td>{{contact.contact_email}}</td>
                            <!-- <td>{{contact.contact_message}}</td> -->
                            <td>{{contact.status}}</td>
                            <td>{{contact.updated_at | moment("from", "now") }}</td>
                            <td style="font-size:18px;">
                                <a href="#" @click="editContact(contact)">
                                    <i class="icon ion-wrench"></i>
                                </a>
                                <a style="margin-left:10px;" href="#" @click="deleteContact(contact.id)">
                                    <i class="icon ion-trash-b"></i>
                                </a>
                            </td>
                        </tr>
                    </table>
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
            </div>
        </div>
    </div>
</template>

<script>
    
</script>