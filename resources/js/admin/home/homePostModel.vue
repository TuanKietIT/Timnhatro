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
                           <a class="active" href="#">Đăng tin</a>
                       </li>
                   </ul>
               </div>
               <a class="btn-download" @click="AddNews">
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
            
                        <div class="service_table-heading-member">
                            <p>ID</p> 
                            <p>Hình ảnh</p>
                            <p>Nội dung</p> 
                            <p>Điện thoại</p> 
                            <p>Ngày cập nhật</p> 
                            <p>Chức năng</p>
                        </div>
                        <!-- post_motels 1 -->
                        <div class="service_table-items-member" v-for="item in post_motels.data" :key="item.id">
                            <p>{{item.id }}</p>
                            <button class="service_table-icon">
                                <div v-if="item.image1">
                                    <img  v-bind:src="'/img/' +item.image1">
                                </div>
                            </button>
                            <p class="description" v-html="item.description"></p>
                            <p>{{ formatPrice(item.price) }} VND/tháng</p>
                            <p>{{ moment(item.created_at).format("DD-MM-YYYY") }}</p>
                            <div>
                                <button class="btn-icon success" @click="editPostMotel(item)">
                                    <i class="fa-solid fa-share-from-square"></i>
                                </button>
                                <button class="btn-icon danger"  @click="deletePostMotel(item)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="container-pagination">
                        <pagination :data="post_motels" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
                    </div>
                    <div class="modal main__modal " v-show="showCreateNews" >
                        <div class="modal__content">
                            <span class="modal__close btn__close--modal" @click="closeNews">×</span>
                            <h3 class="modal__title">Thêm tin tức </h3>
                            <hr class="modal_line"><br>
                            <div>
                                <p>Tiêu đề</p>
                                <input type="text" class="input" v-model="post_motel.title" />
                                <p>Giá</p>
                                <input type="text" class="input" v-model="post_motel.price" />
                                <p>Địa chỉ</p>
                                <input type="text" class="input" v-model="post_motel.address_address" />
                                <p>Diện tích</p>
                                <input type="text" class="input" v-model="post_motel.area" />
                                <p>Lựa chọn</p>
                                <input type="text" class="input" v-model="post_motel.choose" />
                                <p>Nội dung</p>
                                <ckeditor :editor="editor" v-model="post_motel.description" :config="editorConfig"></ckeditor>
                            </div>
                            <br><hr class="modal_line">
                            <div class="model__footer">
                                <button class="btn-scancel" @click="closeModal()">
                                    Cancel
                                </button>
                                <button class="btn-save " v-show="showModelNews" @click="saveNews">Save</button>
                                <button class="btn-update " v-show="showUpdateNews" @click="updateNews">update</button>
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
   import pagination from 'laravel-vue-semantic-ui-pagination'
   import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
   export default{
        components:{
            sidebarVue,headerVue,pagination
        },
        data(){
           return {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
               post_motels:[],
               moment: moment,
               currentPage: 1,
               showCreateNews:false,
               showUpdateNews:false,
               showModelNews:true,
               post_motel:{
                    title:'',
                    price:'',
                    description:'',
                    area:'',
                    address_address:'',
                    choose:''
               },
               id:''
            }
        },

        mounted(){
            this.getResults()
        },
        methods:{
            getResults(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}

				// Using vue-resource as an example
				axios.get('/api/postmotel?page=' + page)
				.then(response => {
                    this.showCreateNews = false
                    this.post_motels = response.data;
                    this.showUpdateNews = false
                    this.showModelNews = true
                    console.log(response.data)
				})
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
            editPostMotel(item){
                this.showUpdateNews = true
                this.showModelNews = false
                this.showCreateNews = true
                this.post_motel.title = item.title
                this.post_motel.price = item.price
                this.post_motel.address_address = item.address_address
                this.post_motel.description = item.description
                this.post_motel.area = item.area
                this.post_motel.choose = item.choose
                this.id = item.id
            },
            updateNews() {
                let mythis = this;
                const formData = new FormData();
                formData.append('choose', this.post_motel.choose);
                axios.post(`/api/postmotel/update/${this.id}`, formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.getResults()
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
            formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', ',')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			formatDate(value) {
				return moment(String(value)).format('MM/DD/YYYY hh:mm')
			},
            deletePostMotel(item){
                var remove = '/api/postmotel/delete/' + item.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id=""
                    this.getResults();
                })
            }
        }

   }
</script>
