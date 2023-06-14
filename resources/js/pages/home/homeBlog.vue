<template>
    <div class="app">
        <homeHeader/>
         <div class="container">
             <div class="section">
                 <div class="content-left">
                     <div class="category">
                        <homeSidebar/>
                      </div>
                     <div class="content-detail">
                         <a v-for="news in news.data" :key="news.id">
                            <div class="news">
								<div class="image-box">
								    <img  v-bind:src="'/img/' + news.image" class="tab-img">
								</div>
								<h3 class="title">
									{{ news.name }}
								</h3>
								<h4 v-html="news.description"></h4>
								<span class="time">{{ formatDate(news.created_at) }}</span>
                                <router-link :to="{ path: '/news/detail/'+ news.id}" class="btn-see"  >
                                        <i class="fa-solid fa-eye"></i>
                                        Xem thêm
                                </router-link>
							</div>
                         </a>
                         <pagination :data="news" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
                     </div>
                 </div>
                 <div class="content-right">
                    <div class="details">
						<div class="img">
							<span class="content-page">Xem tin tức mới cùng Timtro24h.com</span>
							<img class="image" src="../image/backgroundNews.jpg" alt="">
						</div>
					</div>
                 </div>
             </div>
         </div>
         <div class="content-info"> 
             <div class="content-info-title">
                 <span>Giới thiệu sơ lược TimTro24h.com</span>
             </div>
         </div>
         <homeFooter/>
     </div>
 </template>
 
 <script>
     import homeHeader from '../layout/header.vue'
     import moment from 'moment'
     import pagination from 'laravel-vue-semantic-ui-pagination';
     import homeSidebar from '../layout/sidebar.vue'
     import homeFooter from '../layout/footer.vue'
     export default{
         components:{
             homeHeader, pagination,homeFooter,homeSidebar
         },
         data(){
            return {
                news:{},
                users:[],
                location:[],
                moment:moment,
                currentPage: 1,
                logout: false
            }
         },
         mounted(){
            this.getResults();
            this.getHomeCategory();
         },
         methods:{
             
             formatPrice(value) {
                 let val = (value/1).toFixed(2).replace('.', ',')
                 return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
             },
             formatDate(value) {
                 return moment(String(value)).format('MM/DD/YYYY hh:mm')
             },
             /**
              * Get data 
              * @author KietPT
              */
 
             getHomeCategory(){
                 axios.get('/api/showcategory')
                 .then(response =>{
                      this.categories = response.data
                 })
             },
             login(){
                 this.$router.push({ name: "HomeLogin" });
             },
             getResults(page) {
                 if (typeof page === 'undefined') {
                     page = 1;
                 }
 
                 // Using vue-resource as an example
                 axios.get('/api/news?page=' + page)
                     .then(response => {
                         this.news = response.data
                })
             }
         }
          
     }
 </script>