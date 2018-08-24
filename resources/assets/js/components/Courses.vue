<template>
    <div>
        <h2 class="text-center">Courses</h2>
        <p class="text-center">Manage all your institution courses.</p>
        <div class="br-section-wrapper">

            <div class="" v-show="!editMode">
                    <button class="btn btn-primary mg-b-8" @click="newCourse()">New Course</button>
            </div>

            <div class="row" v-show="editMode">
                <div class="col-md-12">
                    <form @submit.prevent="addCourse" class="mb-3">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Course Name" v-model="course.course_name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Course Duration" v-model="course.course_duration">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Course Fee in Rupees" v-model="course.course_fee">
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" data-placeholder="Choose Browser" v-model="course.course_status">
                                <option value="" disabled>Select Status</option>
                                <option value="Pending">Active</option>
                                <option value="Completed">On-Hold</option>
                                <option value="Closed">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="10" placeholder="Course Comments" v-model="course.course_comments"></textarea>
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
                            <th>Course</th>
                            <th>Duration</th>
                            <th class="text-right">Fee</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        <tr v-for="(course) in filterCourses" :key="course.id">
                            <td>C-{{course.id}}</td>
                            <td>{{course.course_name}}</td>
                            <td>{{course.course_duration}}</td>
                            <td class="text-right">{{course.course_fee }} Rs</td>
                            <td class="text-right" style="font-size:18px;">
                                <a href="#" @click="editCourse(course)">
                                    <i class="icon ion-wrench"></i>
                                </a>
                                <a style="margin-left:10px;" href="#" @click="deleteCourse(course.id)">
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
    export default {
    data(){
        return{
            courses: [],
            course: {
                course_name: '',
                course_duration:'',
                course_fee: '',
                course_comments:'',
                status:'',
            },
            course_id:'',
            search:'',
            pagination: {},
            flag: false,
            edit: false,
            editMode: false,
            createMode: true,
        };
    },

    computed:{
        filterCourses: function(){
            return this.courses.filter((course)=>{
                return course.course_name.match(new RegExp(this.search, "i"))
            });
        }
    },

    created() {
    this.fetchData();
    },


    methods: {
        fetchData(page_url) {
            let vm = this;
            page_url = page_url || '/api/courses';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
            this.courses = res.data;
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
        deleteCourse(id) {
            if (confirm('Are You Sure?')) {
                fetch(`api/courses/${id}`, {
                method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert('Course Removed');
                    this.fetchData();
                })
                .catch(err => console.log(err));
            }
        },
        addCourse() {
            if (this.edit === false) {
                // Add
                fetch('api/courses', {
                method: 'post',
                body: JSON.stringify(this.course),
                headers: {
                    'content-type': 'application/json'
                }
        })
          .then(res => res.json())
          .then(data => {
            this.course.course_name = '';
            this.course.course_duration = '';
            this.course.course_fee = '';
            this.course.course_comments = '';
            alert('Course Added');
            this.fetchData();
          })
          .catch(err => console.log(err));
        } else {
            // Update
            fetch('api/courses', {
            method: 'put',
            body: JSON.stringify(this.course),
            headers: {
                'content-type': 'application/json'
            }
            })
            .then(res => res.json())
            .then(data => {
                this.course.course_name = '';
                this.course.course_duration = '';
                this.course.course_fee = '';
                this.course.course_comments = '';
                alert('Course Updated');
                this.fetchData();
            })
            .catch(err => console.log(err));
        }
        this.editMode = false;
        },
        editCourse(course) {
        this.editMode = true;
        this.edit = true;
        this.course.id = course.id;
        this.course.course_id = course.id;
        this.course.course_name = course.course_name;
        this.course.course_fee = course.course_fee;
        this.course.course_duration = course.course_duration;
        this.course.course_comments = course.course_comments;
        this.course.course_status = course.course_status;
        },
        newCourse(){
            this.editMode=true;
            this.edit = false;
            this.course.id = '';
            this.course.course_id = '';
            this.course.course_name = '';
            this.course.course_duration = '';
            this.course.course_fee = '';
            this.course.course_comments = '';
            this.course.course_status = '';
        },
        goBack(){
            this.editMode= false;
            this.edit=false;
        }
    }
    }

</script>