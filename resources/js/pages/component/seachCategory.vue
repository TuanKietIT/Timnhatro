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
                                  <h3>Giá Phòng: dưới 1 triệu</h3>
                                  <h3>Giá Phòng: từ 1 đến 2 triệu</h3>
                                  <h3>Giá Phòng: từ 2 đến 3 triệu</h3>
                                  <h3>Giá Phòng: từ 3 đến 4 triệu</h3>
                                  <h3>Giá Phòng: từ 4 đến 5 triệu</h3>
                                  <h3>Giá Phòng: từ 5 đến 6 triệu</h3>
                                  <h3>Giá Phòng: từ 6 đến 7 triệu</h3>
                                  <h3>Giá Phòng: từ 7 đến 8 triệu</h3>
                                  <h3>Giá Phòng: từ 8 đến 9 triệu</h3>
                                  <h3>Giá Phòng: lớn hơn 10 triệu</h3>
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
                                    <h3 @click="showProduct">{{ cate.name }}</h3>
                                </router-link>
                             </a>
						</div>
						<div class="search-nav-item">
						    <h2>Lọc khu vực</h2>
						    <hr/>
							<a v-for="locate in locations" :key="locate.id">
                                <router-link :to="{ path: '/home/location/'+ locate.id}" class="btn-see" >
                                    <h3>{{ locate.name }}</h3>
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
                postCategoryID:''
            }
         },
         mounted(){
            this.getHomeCategory();
            this.getPostMotelData();
            this.getHomeLocation()
         },
         methods:{
             
             formatPrice(value) {
                 let val = (value/1).toFixed(2).replace('.', ',')
                 return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
             },
             formatDate(value) {
                 return moment(String(value)).format('MM/DD/YYYY hh:mm')
             },
             showProduct(){
                this.getPostMotelData()
                this.postCategoryID = this.$route.params.id;
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
               var show = '/api/searchPostMotelByCategoryID/' + this.postCategoryID
               axios.get(show).then(response =>{
                    this.post_motels = response.data.post_motels
                    this.postCategoryID = ''
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
         }
          
     }
 </script>