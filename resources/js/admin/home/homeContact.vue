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
                           <a class="active" href="#">Liên hệ</a>
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
                            <p>Họ và tên</p>
                            <p>Nội dung</p> 
                            <p>Điện thoại</p> 
                            <p>Ngày cập nhật</p> 
                            <p>Chức năng</p>
                        </div>
                        <!-- contacts 1 -->
                        <div class="service_table-items-member" v-for="contact in contacts.data" :key="contact.id">
                            <p>{{contact.id }}</p>
                            <p>{{contact.name}}</p>
                            <p>{{contact.desc}}</p>
                            <p>{{contact.phone}}</p>
                            <p>{{ moment(contact.created_at).format("DD-MM-YYYY") }}</p>
                            <div>
                                <button class="btn-icon success" >
                                    <i class="fa-solid fa-share-from-square"></i>
                                </button>
                                <button class="btn-icon danger"  @click="deleteContact(contact)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="container-pagination">
                            <pagination :data="contacts" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
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
   export default{
        components:{
            sidebarVue,headerVue,pagination
        },
        data(){
           return {
               contacts:[],
               moment: moment,
               currentPage: 1,
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
				axios.get('/api/contact?page=' + page)
				.then(response => {
                    this.showCreateNews = false
                    this.contacts = response.data;
                    this.showUpdateNews = false
                    this.showModelNews = true
				})
			},
            deleteContact(contact){
                var remove = '/api/contact/delete/' + contact.id;
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
