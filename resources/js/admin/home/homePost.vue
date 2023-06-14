<template>
    <sidebarVue />
   <!-- CONTENT -->
   <section id="content">
       <headerVue />

       <!-- MAIN -->
       <main>
           <div class="head-title">
               <div class="left">
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">Dashboard</a>
                       </li>
                       <li><i class='bx bx-chevron-right' ></i></li>
                       <li>
                           <a class="active" href="#">Tim người ở gép</a>
                       </li>
                   </ul>
               </div>
           </div>
           <div class="searchbox">
                <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                    <li  style="color: red;font-size: 1.5rem;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                 </ul>
            </div>
            <section class="services section" id="services">
                <div class="services_container">

                    <div class="table">
                        <div class="table_search">
                            <div class="table_search-wrapper">
                                <select class="table_search-select" name="" id="">
                                    <option value="">Filter</option>
                                </select>
                            </div>
                            <div class="relative">
                                <i class="table_search-input--icon fas fa-search "></i>
                                <input class="table_search--input" type="text" placeholder="Search Service">
                            </div>
                        </div>
            
                        <div class="service_table-heading">
                            <p>ID</p> 
                            <p>Ngày tạo</p>
                            <p>Nội dung</p>
                            <p></p>
                            <p>Chức năng</p>
                        </div>
                        <!-- item 1 -->
                        <div class="service_table-items" v-for="item in post" :key="item.id">
                            <p>{{ item.id }}</p>
                            <p>{{ moment(item.created_at).format("DD-MM-YYYY") }}</p>
                            <p>{{ item.description }}</p>
                            <p></p>
                            <div>
                                <button class="btn-icon danger"  @click="deletePost(item)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
                
        </main>
   </section>
</template>

<script>
   import moment from "moment";
   import sidebarVue from '../layout/sidebar.vue'
   import headerVue from '../layout/header.vue';
   
   export default{
        components:{
            sidebarVue,headerVue
        },
        data(){
           return {
                errorList:'',
                post:[],
                id:'',
                description: '',
                moment: moment
           }
        },

        mounted(){
            this.getPost()
        },
        methods:{
            getPost() {
                axios.get('/api/post')
                .then(response => {
                    this.post = response.data;
                })
            },
            savePost(e) {
                let mythis = this;
                const formData = new FormData();
                formData.append('description', this.description);

                axios.post('/api/post/create', formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.getPost()
                })
                .catch(function (error){
                    if(error.response){
                        if (error.response.status === 422) {
                            mythis.errorList = error.response.data.errors;
                        }
                        else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    }
                })
            },
            deletePost(item){
                var remove = '/api/post/delete/' + item.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id = ""
                    this.description= '',
                    this.getPost();
                })
            }

        }

   }
</script>
