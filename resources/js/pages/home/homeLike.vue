<template>
    <div class="app">
        <homeHeader/>
        <homeSearch/>
         <div class="container">
             <div class="section">
                 <div class="content-left">
                     <div class="category">
                         <homeSidebar/>
                      </div>
                     <div class="content-detail">
                        <div class="small-container cart-page">
					        <table>
					            <tr>
					                <th class="info-data-1">Hình ảnh</th>
					                <th class="text-center">Diện tích</th>
					                <th class="text-center">Chức năng</th>
                                    <th>Thông tin</th>
					            </tr>
					            <tr v-for="like in likes" :key="like.id">
					                <td>
					                    <div class="cart-info">
					                        <img v-bind:src="'/img/' + like.post_motel.image1" alt="" />
					                        <div>
					                            <p>{{ like.post_motel.title }}</p>
					                            <p>Mức giá: {{ formatPrice(like.post_motel.price) }} VND/tháng</p>
					                            <br/>
					                         </div>
					                    </div>
					                </td>
					                <td class="text-center">
					                   {{ like.post_motel.area }} m2
					                </td>
					                <td >
                                        <div class="text-center" @click="deleteLike(like)">
                                            <a  class="like-icon"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </td> 
                                    <td>
                                        <router-link :to="{ path: '/home/product/' + like.post_motel.id} " class="info-data">
                                                Xem thông tin
                                        </router-link>
                                    </td>	
                                </tr>  
					        </table>
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
     import homeFooter from '../layout/footer.vue'
     import homeSidebar from '../layout/sidebar.vue'
     import homeSearch from '../component/searchPostMoTel.vue'
     import moment from 'moment'
     import pagination from 'laravel-vue-semantic-ui-pagination';
 
     
     export default{
         components:{
             homeHeader, pagination,homeFooter,homeSearch,homeSidebar
         },
         data(){
            return {
                likes:[],
                categories:[],
                locations:[],
                moment:moment,
                currentPage: 1,
                logout: false
            }
         },
         mounted(){
            this.getHomeCategory();
            this.getHomeLocation();
            this.getData();
         },
         methods:{
             formatPrice(value) {
                 let val = (value/1).toFixed(0).replace('.', ',')
                 return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
             },
             formatDate(value) {
                 return moment(String(value)).format('hh:mm MM/DD/YYYY')
             },
             /**
              * Get data 
              * @author KietPT
              */
            getData(){
                const token = localStorage.getItem('token');
                if(token){
                    this.getHomeLike()
                }
                else{
                    this.$router.push({ name: "HomeLogin" }); 
                }
            },
            getHomeLike(){
                 axios.get('/api/like')
                 .then(response =>{
                    this.likes = response.data
                 })
             },
 
             getHomeCategory(){
                 axios.get('/api/showcategory')
                 .then(response =>{
                      this.categories = response.data
                 })
             },
             login(){
                 this.$router.push({ name: "HomeLogin" });
             },
             getHomeLocation(){
                 axios.get('/api/showLocation')
                 .then(response =>{
                      this.locations = response.data
                 })
             },
             deleteLike(like){
                var remove = '/api/like/delete/' + like.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id=""
                    this.getHomeLike();
                    this.login = false
                })
             }
         }
          
     }
 </script>