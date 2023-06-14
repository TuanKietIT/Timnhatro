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
                           <a class="active" href="#">Tin tức</a>
                       </li>
                   </ul>
               </div>
               <a class="btn-download" @click="AddNews">
                   <i class='bx bxs-cloud-download' ></i>
                   <span class="text">Create</span>
               </a>
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
                            <p>Hình ảnh</p>
                            <p>Tiêu đề</p> 
                            <p>Ngày đăng</p> 
                            <p>Chức năng</p>
                        </div>
                        <!-- item 1 -->
                        <div class="service_table-items" v-for="item in news.data" :key="item.id">
                            <p>{{ item.id }}</p>
                            <button class="service_table-icon">
                                <div v-if="item.image">
                                    <img  v-bind:src="'/img/' +item.image">
                                </div>
                            </button>
                            <p>{{item.name}}</p>
                            <p>{{ moment(item.created_at).format("DD-MM-YYYY") }}</p>
                            <div>
                                <button class="btn-icon success"  @click="editNews(item)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger"  @click="deleteNews(item)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal main__modal " v-if="showCreateNews" >
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal" @click="closeNews">×</span>
                        <h3 class="modal__title">Thêm tin tức </h3>
                        <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                            <li  style="color: red;font-size: 1.5rem;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                        </ul>
                        <hr class="modal_line"><br>
                        <div>
                            <p>Tiêu đề</p>
                            <input type="text" class="input" v-model="name" />

                            <p>Hình ảnh</p>
                            <input type="file" class="image" v-on:change="onChange">
                            <div v-if="img">
                                <img v-bind:src="imgPreview" width="150" height="100"/>
                            </div>

                            <p>Nội dung</p>
                            <ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
                        </div>
                        <br><hr class="modal_line">
                        <div class="model__footer">
                            <button class="btn-scancel" @click="closeModal()">
                                Cancel
                            </button>
                            <button class="btn-save " v-if="showModelNews" @click="saveNews">Save</button>
                            <button class="btn-update " v-if="showUpdateNews" @click="updateNews">update</button>
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
   import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
   
   export default{
        components:{
            sidebarVue,headerVue
        },
        data(){
           return {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
               errorList:'',
               news:[],
               showCreateNews:false,
               showUpdateNews:false,
               showModelNews:true,
               id:'',
               name: '',
               description: '',
               img: '',
               imgPreview: null,
               moment: moment
           }
        },

        mounted(){
            this.getNews()
        },
        methods:{
            AddNews(){
                this.showCreateNews = true
            },
            closeNews(){
                this.showCreateNews = false
                this.id = ""
                this.name= '',
                this.description= '',
                this.img= '',
                this.imgPreview= null,
                this.getNews()
            },
            getNews() {
                axios.get('/api/news')
                .then(response => {
                    this.showCreateNews = false
                    this.news = response.data;
                    this.showUpdateNews = false
                    this.showModelNews = true
                    console.log(this.news)
                })
            },
            onChange(e) {
                this.img = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview = reader.result;
                }.bind(this), false);

                if (this.img) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.img.name ) ) {
                        reader.readAsDataURL( this.img );
                    }
                }
            },
            saveNews(e) {
                let mythis = this;
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('file', this.img);

                axios.post('/api/news/create', formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.getNews()
                    this.closeNews()
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
            editNews(item){
                this.showUpdateNews = true
                this.showModelNews = false
                this.showCreateNews = true
                this.id = item.id
                this.name = item.name 
                this.img = item.image 
                this.description = item.description   
            },
            updateNews() {
                let mythis = this;
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('description', this.description);
                formData.append('file', this.img);
                axios.post(`/api/news/update/${this.id}`, formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.getNews()
                    this.closeNews()
                    this.id = ""
                    this.name= '',
                    this.description= '',
                    this.img= '',
                    this.imgPreview= null
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
            deleteNews(item){
                var remove = '/api/news/delete/' + item.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id = ""
                    this.name= '',
                    this.description= '',
                    this.img= '',
                    this.imgPreview= null
                    this.getNews();
                })
            }

        }

   }
</script>
