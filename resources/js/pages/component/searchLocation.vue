<template>
    <div class="app">
        <homeHeader/>
         <div class="container">
             <div class="section">
                 <div class="content-left">
                     <div class="category">
                          <div class="search-catagory">
                              <h2>Xem theo diện tích phòng</h2>
                              <hr/>
                              <a >
                                  <h3>Diện tích: dưới 10 m²</h3>
                                  <h3>Diện tích: dưới 12 m²</h3>
                                  <h3>Diện tích: dưới 15 m²</h3>
                                  <h3>Diện tích: dưới 18 m²</h3>
                                  <h3>Diện tích: dưới 20 m²</h3>
                                  <h3>Diện tích: dưới 23 m²</h3>
                                  <h3>Diện tích: dưới 25 m²</h3>
                              </a>
                          </div>
                      </div>
                     <div class="content-detail">
                         <a v-for="post in post_motels" :key="post.id">
                             <div class="details">
                                 <div class="image-box">
                                 <img v-bind:src="'/img/' + post.image1" class="tab-img">
                                 </div>
                                 <h3 class="title">
                                     {{ post.title }}
                                 </h3>
                                 <hr/>
                                 <h4 class="description-page" v-html="post.description">
                                 </h4>
                                 <div class="infor">
                                     <p >
                                         Giá: {{ formatPrice(post.price) }} VND/tháng
                                     </p>
                                     <p class="space">
                                         -
                                     </p>
                                     <p >
                                         Diện tích:  {{ post.area }} m²
                                     </p>
                                 </div>
                                 <span class="time">
                                     Thời gian đăng: {{ formatDate(post.created_at) }}
                                 </span>
                                 <a>
                                     <router-link :to="{ path: '/home/product/'+ post.id}" class="btn-see" >
                                         <i class="fa-solid fa-eye"></i>
                                         Xem thêm
                                     </router-link>
                                 </a>
                             </div>
 
                         </a>
                  </div>
                 </div>
                 <div class="content-right">
                    <div class="details">
						<div class="search-catagory">
						    <h2>Lọc Theo danh mục</h2>
						    <hr/>
                            <a v-for="cate in categories" :key="cate.id">
                                <router-link :to="{ path: '/home/category/'+ cate.id}" class="btn-see" >
                                    <h3>{{ cate.name }}</h3>
                                </router-link>
                             </a>
						</div>
						<div class="search-nav-item">
						    <h2>Lọc khu vực</h2>
						    <hr/>
							<a v-for="locate in locations" :key="locate.id">
                                <router-link :to="{ path: '/home/location/'+ locate.id}" class="btn-see" >
                                    <h3 @click="showProductLocation">{{ locate.name }}</h3>
                                </router-link>
                             </a>
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
     import homeFooter from '../layout/footer.vue'
     
     export default{
         components:{
             homeHeader, pagination,homeFooter
         },
         data(){
            return {
                post_motels:{},
                categories:[],
                users:[],
                locations:[],
                moment:moment,
                currentPage: 1,
                logout: false,
                postLocationID:''
            }
         },
         mounted(){
            this.getHomeCategory();
            this.getPostMotelData();
            this.getHomeLocation();
            this.postLocationID = this.$route.params.id;
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
             getPostMotelData(){
                this.postLocationID = this.$route.params.id;
               var show = '/api/searchPostMotelByLocationID/' + this.postLocationID
               axios.get(show).then(response =>{
                    this.post_motels = response.data.post_motels
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
                           alert(error.response.data.message);
                       }
                   }
               })
            },
            getHomeLocation(){
                axios.get('/api/showLocation')
                .then(response =>{
                     this.locations = response.data
                })
            },
            showProductLocation(){
                this.getPostMotelData()
             },
         }
          
     }
 </script>