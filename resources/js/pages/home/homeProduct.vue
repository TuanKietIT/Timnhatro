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
                        <a>
                            <div class="image-postup">
					              <img  v-bind:src="'/img/' + post_motels.image1" class="tab-img" />
					        </div>
					        <div class="info-postup">
					        <h3>{{ post_motels.title }}</h3>
					        <span class="local">Địa chỉ:{{ post_motels.address_address }} </span>
					         <hr/>
                             <div class="postup-card">
					            <span>
					                <p>Số Lượt xem: {{ post_motels.see }}</p>
					            </span>
					            <span>
					                <p>Thời gian:</p>
					            </span>
					        </div>
                            <hr/>
					        <div class="postup-card">
					            <span>
					                <p>Mức giá: {{ formatPrice(post_motels.price) }} VND/tháng</p>
					            </span>
					            <span>
					                <p>Diện tích: {{ post_motels.area }}m²</p>
					            </span>
					            <span>
					                <p>Cập nhật: {{ formatDate(post_motels.created_at) }} </p>
					            </span>
                                <button type="submit" @click="saveLike">
                                    Thêm yêu thích
					                <i class="fa-solid fa-heart btn-like"></i>
					            </button>
					        </div>
					        <hr/>
					        <div class="info-desc">
					            <h5>Thông tin mô tả</h5>
					            <span v-html="post_motels.description">   		            
                                </span>
					        </div>
					        <hr/>
					        <div class="postup-card">
					            <span>
					                <p>Tiền cọc:  {{ formatPrice(post_motels.deposit) }}  VND</p>
					            </span>
					            <span>
					                <p>Mục đích: {{ post_motels.purpose }}</p>
					           </span>
					            <span>
					                <p>Khu vực: {{ locationName}}</p>
					            </span>
					            <span>
					            <p>Tình trạng: {{ post_motels.structure }}</p>
					             </span>
					             </div>
					            <hr/>
                                <div class="custombox clearfix">
				                    <span class="small-title">Bình luận</span>
                                    <div class="contact-form">
                                        <form class="form-wrapper">
                                            <textarea rows="5" style="resize: none" class="form-control" placeholder="Nội dung"></textarea>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Gửi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                              
					        </div>
                        </a>
                     </div>
                 </div>
                 <div class="content-right">
                     <div class="details">
                        <div class=" details-info">
                            <img class="info-avatar" v-bind:src="'/img/' + image" alt=""/>
                        </div>
                        <p class="center">{{ name }}</p>
                        <div class=" details-info">
                            <i class="fa-solid fa-phone"></i>
                            <span>{{ email }}</span>
                        </div>
                        <div class=" details-info">
                            <i class="fa-solid fa-envelope"></i>
                            <span>{{ phone }}</span>
                        </div>
                        <div class=" details-info">
                            <i class="fa-solid fa-business-time"></i>
                            <span>Mô giới</span>
                        </div>
                        <div class=" details-info">
                            <i class="fa-solid fa-eye"></i>
                            <span>Hoạt đông 10 giờ trước</span>
                        </div>
                        <div class=" details-info">
                            <i class="fa-solid fa-star"></i>
                            <span>Đánh giá: 5 sao</span>
                        </div>
                        <button class="btn-see-info">Xem thông tin trang</button>
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
     import homeFooter from '../layout/footer.vue'
     import homeSidebar from '../layout/sidebar.vue'
     export default{
         components:{
             homeHeader,homeFooter,homeSidebar
         },
         data(){
            return {
                post_motels:[],
                postMotelId:'',
                categories:[],
                users:[],
                location:[],
                moment:moment,
                dateCurent:'',
                like:{
                    post_id:'',
                    user_id:''
                },
                image:'',
                name:'',
                email:'',
                phone:'',
                locationName:''

            }
         },
         mounted(){
            this.postMotelId = this.$route.params.id;
            this.getPostMotelData()
            this.getHomeCategory();
            this.getInfoUser();
         },
         methods:{
            getPostMotelData(){
               var show = '/api/productPostMotel/' + this.postMotelId
               axios.get(show).then(response =>{
                    this.post_motels = response.data.post_motels
                    this.like.post_id = response.data.post_motels.id
                    this.image = response.data.post_motels.user.image
                    this.name = response.data.post_motels.user.name
                    this.email = response.data.post_motels.user.email
                    this.phone = response.data.post_motels.user.phone
                    this.locationName = response.data.post_motels.location.name
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
                           alert(error.response.data.message);
                       }
                   }
               })
            },
             getHomeCategory(){
                 axios.get('/api/showcategory')
                 .then(response =>{
                      this.categories = response.data
                 })
             },
            formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', ',')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			formatDate(value) {
				return moment(String(value)).format('MM/DD/YYYY hh:mm')
			},
            getInfoUser(){
                const token = localStorage.getItem('token');
                axios.get('/api/user',{
                    headers:{
                        Authorization: ' Bearer ' + token
                    }
                })
                .then(response => {
                    this.like.user_id = response.data[0].id
                })
            },
            saveLike(){
                axios.post('/api/like/create', this.like)
                .then(response =>{
                    alert(response.data.message);
                })
                .catch(function (error){
                   
                })
            }
         }
          
     }
 </script>