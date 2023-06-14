<template>
    <div class="app">
         <homeHeader/>
         <div class="container">
             <div class="section">
                <div class="login-divr">
                            <div class="login-fieldr">
                                <div class="logo-titler">
                                    <span>Đăng Ký</span>
                                </div>
                                <div style="margin: 10px 20px;">
                                    <span style="color: red;font-size: 1.5rem;" v-html="errorList.name"></span>
                                </div>
                                <div class="usernamer">
                                    <input type="text" v-model="user.name"  placeholder="Name"  maxlength="50">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div style="margin: 5px 20px;">
                                    <span style="color: red;font-size: 1.5rem;" v-html="errorList.email"></span>
                                </div>
                                <div class="usernamer">
                                    <input type="email" v-model="user.email" placeholder="Email" maxlength="50">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div style="margin: 5px 20px;">
                                    <span style="color: red;font-size: 1.5rem;" v-html="errorList.email"></span>
                                </div>
                                <div class="passwordr">
                                    <input :type="passwordFieldType" v-model="user.password" placeholder="mật khẩu" minlength="8" maxlength="16">
                                    <i class="fa-solid fa-unlock-keyhole i" ></i>
                                    <i class="fa-solid fa-eye before" @click="showEyePass" v-if="showEye"></i>
                                </div>
                                <div class="passwordr">
                                    <input :type="passwordFieldType" v-model="user.c_password" placeholder="mật khẩu" minlength="8" maxlength="16">
                                    <i class="fa-solid fa-unlock-keyhole i"></i>
                                    <i class="fa-solid fa-eye before" @click="showEyePass" v-if="showEye"></i>
                                </div>
                                <div class="usernamer">
                                    <input type="number" v-model="user.phone" id="quantity" placeholder="phone"   min="10" max="10s">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="usernamer">
                                    <input type="text" v-model="user.address" placeholder="Địa chỉ" maxlength="250">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="usernamer">
                                   <textarea name="" id="" v-model="user.description" cols="30" rows="5"></textarea>
                                   <i class="fa-solid fa-audio-description"></i>
                                </div>
                                <div class="btn-controlr">
                                    <button class="signup-btnr" @click.prevent="saveUser">Đăng Ký</button>
                                </div>
                            </div>
                        </div>
                        <Loading :active="isLoading" 
                    :can-cancel="true" 
                    :is-full-page="fullPage"></Loading>        
             </div>
         </div>
         <footer>
             <div class="rows">
                 <div class="col">
                     <span class="logo-info">
                         <img class="logo-1" src="{{asset('public/font-end/image/logo.png')}}" alt="">
                         <p>Thuetro24h.com</p>
                     </span>
                     <h4>
                         Website mở nhằm mục đích giúp khách hàng có thể tìm được nhà trọ thích hợp nhanh chống và tiện lợi thiêu nhu cầu của mỗi người
                         Cảm ơn quý khách đã quan tâm đến.
                         Chúc quý khách có thể tìm được trọ phù hợp với nhu cầu của mình !!!
                     </h4>
                 </div>
                 <div class="col">
                     <h3><div class="underline"><span></span></div>Giới thiệu</h3>
                     <p>
                         Thuetro24h hoạt động 24/24
                         Website mở nhằm mục đích giúp khách hàng có thể tìm được nhà trọ thích hợp nhanh chống và tiện lợi thiêu nhu cầu của mỗi người
                     </p>
                     <p> 
                         Kinh doanh trong hạnh phúc
                     </p>
                     <p> 
                         Vừa lòng khách đến vừa lòng khách đi 
                     </p>
                     <p> 
                         Hoạt động tối đa  
                     </p>
                 </div>
                 <div class="col">
                    <h3><div class="underline"><span></span></div> Danh mục</h3>
                    <li class="footer-menu"><a class="a" href="">Trang chủ</a></li>
                    <li class="footer-menu"><a class="a" href="">Quản lý tin</a></li>
                    <li class="footer-menu"><a class="a" href="">Tin tức</a></li>
                    <li class="footer-menu"><a class="a" href="">Yêu thích</a></li>
                    <li class="footer-menu"><a class="a" href="">Liên hệ</a></li>
                    <li class="footer-menu"><a class="a" href="">Đăng tin</a></li>
 
                 </div>
                 <div class="col">
                     <h3><div class="underline"><span></span></div>Bản tin</h3>
                     <form>
                         <i class="fa-solid fa-square-envelope"></i>
                         <input type="email" placeholder=" Email....." required>
                         <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
                     </form>
                     <div class="social-icons">
                         <a href="" ><i class="fav fa-brands fa-facebook-f"></i></a>
                         <a href="" ><i class="fav fa-brands fa-instagram"></i></a>
                         <a href="" ><i class="fav fa-regular fa-envelope"></i></a>
                         <a href="" ><i class="fav fa-brands fa-twitter"></i></a>
                     </div>
                 </div>
             </div>
         </footer>
     </div>
 </template>
 
 <script>
    import Loading from 'vue3-loading-overlay';
    import 'vue3-loading-overlay/dist/vue3-loading-overlay.css';
     import homeHeader from '../layout/header.vue'
     export default{
         components:{
             homeHeader,Loading
         },
         data(){
            return {
                users:[],
                errorList:'',
                user:{
                    name: '',
                    email: '',
                    password: '',
                    c_password: '',
                    address: '',
                    phone: '',
                    description: '',
                    image:'user.png'
                },
                passwordFieldType: "password",
                showEye:true,
                isLoading: false,
                fullPage:true,
            }
         },
         mounted(){
            this.getHomeCategory();
         },
         methods:{
            showEyePass() {
                this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
            },
             /**
              * Get data category
              * @author KietPT
              */
            getHomeCategory(){
                axios.get('/api/showcategory')
                .then(response =>{
                     this.categories = response.data
                })
            },
            saveUser(){
                this.isLoading = true;
                var mythis = this;
                axios.post('/api/sigup', this.user)
                .then(response =>{
                    console.log(response.data)
                    alert(response.data.message);
                    setTimeout(() => {this.isLoading = false},2000)
                    this.$router.push({ name: "HomeLogin" });
                })
                .catch(function (error){
                    if(error.response){
                        if (error.response.status === 422) {
                            mythis.errorList = error.response.data.errors;
                            mythis.isLoading = false
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