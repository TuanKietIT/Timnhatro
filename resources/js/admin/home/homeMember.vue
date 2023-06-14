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
                           <a class="active" href="#">Thành viên</a>
                       </li>
                   </ul>
               </div>
               <a class="btn-download" @click="AddUser">
                   <i class='bx bxs-cloud-download' ></i>
                   <span class="text">Create</span>
               </a>
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
            
                        <div class="service_table-heading-User">
                            <p>ID</p> 
                            <p>Hình ảnh</p>
                            <p>Họ và tên</p> 
                            <p>Số điện thoại</p> 
                            <p>Ngày Tạo</p> 
                            <p>Chức năng</p>
                        </div>
                        <!-- item 1 -->
                        <div class="service_table-items-User" v-for="items in  users" :key="items.id">
                            <p>{{ items.id }}</p>
                            <button class="service_table-icon">
                                <div v-if="items.image">
                                    <img  v-bind:src="'/img/' +items.image">
                                </div>
                            </button>
                            <p>{{items.name}}</p>
                            <p>{{items.phone}}</p>
                            <p>{{ moment(items.created_at).format("DD-MM-YYYY") }}</p>
                            <div>
                                <button class="btn-icon success"  @click="editUser(items)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger"  @click="deleteUser(items)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal main__modal " v-if="showCreateUser" >
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal" @click="closeUser">×</span>
                        <h3 class="modal__title">Thêm tin tức </h3>
                        <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                            <li  style="color: red;font-size: 1.5rem;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                        </ul>
                        <hr class="modal_line"><br>
                        <div>
                            <p>Tiêu đề</p>
                            <input type="text" class="input" v-model="name" />
                            <p>Email</p>
                            <input type="email" class="input" v-model="email" />
                            <p>Mật khẩu</p>
                            <input type="password" class="input" v-model="password" />
                            <p>Nhập lại</p>
                            <input type="password" class="input" v-model="c_password" />
                            <p>Điện thoại</p>
                            <input type="text" class="input" v-model="phone" />
                            <p>Địa chỉ</p>
                            <input type="text" class="input" v-model="address" />
                            <p>Hình ảnh</p>
                            <input type="file" class="form-control mb-2" v-on:change="onChange">
                            <div v-if="img">
                                <img v-bind:src="imgPreview" width="150" height="100"/>
                            </div>

                            <p>Nội dung</p>
                            <textarea cols="10" rows="5"  v-model="description"></textarea>

                        </div>
                        <br><hr class="modal_line">
                        <div class="model__footer">
                            <button class="btn-scancel" @click="closeModal()">
                                Cancel
                            </button>
                            <button class="btn-save " v-if="showModelUser" @click="saveUser">Save</button>
                            <button class="btn-update " v-if="showUpdateUser" @click="updateUser">update</button>
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
               users:[],
               showCreateUser:false,
               showUpdateUser:false,
               showModelUser:true,
               id:'',
               name: '',
               email: '',
               password:'',
               c_password:'',
               address: '',
               phone:'',
               description: '',
               img: '',
               imgPreview: null,
               moment: moment
           }
        },

        mounted(){
            this.getUser()
        },
        methods:{
            AddUser(){
                this.showCreateUser = true
            },
            closeUser(){
                this.showCreateUser = false
                this.id = ""
                this.name= '',
                this.description= '',
                this.img= '',
                this.imgPreview= null,
                this.getUser()
            },
            getUser() {
                axios.get('/api/home-user')
                .then(response => {
                    this.showCreateUser = false
                    this.users = response.data
                    console.log(this.users)
                    this.showUpdateUser = false
                    this.showModelUser = true
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
            saveUser(e) {
                let mythis = this;
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('password', this.password);
                formData.append('c_password', this.c_password);
                formData.append('address', this.address);
                formData.append('phone', this.phone);
                formData.append('description', this.description);
                formData.append('file', this.img);

                axios.post('/api/sigup', formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.getUser()
                    this.closeUser()
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
            editUser(items){
                this.showUpdateUser = true
                this.showModelUser = false
                this.showCreateUser = true
                this.id = items.id
                this.name = items.name 
                this.email = items.email 
                this.password = items.password 
                this.c_password = items.c_password 
                this.address = items.address 
                this.phone = items.phone 
                this.img = items.img 
                this.description = items.description   
            },
            updateUser() {
                let mythis = this;
                const formData = new FormData();
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('password', this.password);
                formData.append('c_password', this.c_password);
                formData.append('address', this.address);
                formData.append('phone', this.phone);
                formData.append('description', this.description);
                formData.append('file', this.img);
                axios.post(`/api/User/update/${this.id}`, formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.getUser()
                    this.closeUser()
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
            deleteUser(items){
                var remove = '/api/User/delete/' + User.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id = ""
                    this.name= '',
                    this.description= '',
                    this.img= '',
                    this.imgPreview= null
                    this.getUser();
                })
            }

        }

   }
</script>
