
<template>
    <div>
        <h2 class="text-center">Query Register</h2>
        <p class="text-center">Manage all your queries in a blink of an eye.</p>
        <div class="br-section-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                    <input class="form-control mg-b-20" type="text" placeholder="Search for some data in here." v-model="search">
                    </div>
                    <div class="col-md-2">
                    <button class="btn btn-primary" @click="fetchData">Get Data</button>
                    </div>

                    </div>
                <div class="row">
                    <table class="table table-striped">
                        <tr v-for="(query,n) in filterQueries" :key="query.id">
                            <td>{{n+1}}</td>
                            <td>{{query.qr_name}}</td>
                            <td>{{query.qr_course}}</td>
                            <td>{{query.qr_number}}</td>
                            <td>{{query.created_at}}</td>
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
            query: {
                name: '',
                course: ''
            },
            search: '',
            flag: false,
            queries: [],
        };
    },

    computed:{
        filterQueries: function(){
            return this.queries.filter((query)=>{
                return query.qr_name.match(new RegExp(this.search, "i")) || query.qr_course.match(new RegExp(this.search, "i"))
            });
        }
    },

    created() {
    this.fetchData();
    },


    methods: {
        fetchData: function() {

            this.$http.get('http://127.0.0.1:8000/api/queries')
                .then(response => {
                    return response.json();
                })
                .then (data => {
                console.log(data);
                this.queries = data.data;
                });

        }
        
    }
}
</script>