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
                            <div class="contact-user">
                                <div class="box">
                                    <div class="contact form">
                                        <h3>Liên hệ</h3>
                                        <form  id="manage-supplier">
                                            <div class="form-box">
                                                <div class="row100">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.name"></span>
                                                    <div class="input-info">
                                                        <input type="text" v-model="contact.name" placeholder="Họ tên *">
                                                        <i class="fa-solid fa-circle-user icon-contact"></i>
                                                    </div>
                                                </div>
                                                <div class="row100">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.phone"></span>
                                                    <div class="input-info">
                                                        <input type="text" v-model="contact.phone" placeholder="Số điện thoại *">
                                                        <i class="fa-solid fa-phone icon-contact"></i>
                                                    </div>
                                                </div>
                                                <div class="row100">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.email"></span>
                                                    <div class="input-info">
                                                        <input type="email" v-model="contact.email" placeholder="Email *">
                                                        <i class="fa-solid fa-envelope icon-contact"></i>
                                                    </div>
                                                </div>
                                                <div class="row100">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.title"></span>
                                                    <div class="input-info">
                                                        <input type="text" v-model="contact.title" placeholder="Tiêu đề">
                                                        <i class="fa-solid fa-pen-to-square icon-contact"></i>
                                                    </div>
                                                </div>
                                                <div class="row100">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.desc"></span>
                                                    <div class="input-info">
                                                        <textarea rows="5" v-model="contact.desc" placeholder="Nhập nội dung...."></textarea>
                                                        <i class="fa-solid fa-comment icon-contact-textarea"></i>
                                                    </div>
                                                </div>
                                                <div class="row100">
                                                    <div class="input-info">
                                                        <input type="submit" @click.prevent="saveContact" value="gửi">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="contact info">
                                        <h3>Thông tin liên hệ</h3>
                                        <div class="info-box">
                                            <div>
                                                <span><i class="fa-solid fa-location-dot"></i></span>
                                                <p>475 Điện Biên Phủ, phường 25, quận Bình Thạnh, Tp Hồ Chí Minh</p>
                                            </div>
                                            <div>
                                                <span><i class="fa-solid fa-envelope"></i></span>
                                                <a href="mailto:tuankietity@gmail.com">tuankietity@gmail.com</a>
                                            </div>
                                            <div>
                                                <span><i class="fa-solid fa-phone"></i></span>
                                                <a href="tel:0768173369">+076 8173369</a>
                                            </div>
                                            <div class="social-icons">
                                                <a href=""><i class="fav fa-brands fa-facebook-f"></i></a>
                                                <a href=""><i class="fav fa-brands fa-instagram"></i></a>
                                                <a href=""><i class="fav fa-regular fa-envelope"></i></a>
                                                <a href=""><i class="fav fa-brands fa-twitter"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contact map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.1264536544318!2d106.71226751483661!3d10.801625761681633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a5a7e26497%3A0xd6b32389e19641de!2zNDc1IMSQaeG7h24gQmnDqm4gUGjhu6csIFBoxrDhu51uZyAyNSwgQsOsbmggVGjhuqFuaCwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1668878172488!5m2!1svi!2s"
                                width="100%" height="520" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </a>
                     </div>
                 </div>
                 <div class="content-right">
                     <div class="details">
                        <div class=" details-info">
                            <img class="info-avatar" src="../image/avata.jpg" alt=""/>
                        </div>
                        <p>Phan Tuấn Kiệt</p>
                        <div class=" details-info">
                            <i class="fa-solid fa-phone"></i>
                            <span>0989392900</span>
                        </div>
                        <div class=" details-info">
                            <i class="fa-solid fa-envelope"></i>
                            <span>tuankietity@gmail.com</span>
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
                categories:[],
                contact:{
                    name:'',
                    title:'',
                    email:'',
                    phone:'',
                    desc:'',
                },
                errorList:[]
            }
         },
         mounted(){
            this.postMotelId = this.$route.params.id;
            this.getHomeCategory();
         },
         methods:{
             getHomeCategory(){
                 axios.get('/api/showcategory')
                 .then(response =>{
                      this.categories = response.data
                 })
             },
             saveContact(){
                var mythis = this;
                axios.post('/api/contact/create', this.contact)
                .then(response =>{
                    alert(response.data.message);

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
         }
          
     }
 </script>