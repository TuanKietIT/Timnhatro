<template>
    <div class="app">
         <homeHeader/>
         <div class="content">
            <div class="container">
             <div class="section">
                <div class="login-div">
                    <div class="login-field">
                        <div class="logo-title">
                            <span>Đăng nhập</span>
                        </div>
                        <ul v-if="Object.keys(errorList).length > 0" style="margin: 10px 20px;">
                        <li  style="color: red;font-size: 1.5rem;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                        </ul>
                        <div class="username">
                            <input type="email" v-model="login.email" placeholder="Email">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="password">
                            <input :type="passwordFieldType" v-model="login.password" placeholder="mật khẩu" >
                            <i class="fa-solid fa-unlock-keyhole i"></i>
                            <i class="fa-solid fa-eye before" @click="showEyePass" v-if="showEye"></i>
                        </div>
                        <div class="btn-control">
                            <button class="signin-btn" @click.prevent="loginMember">Đăng nhập</button>
                        </div>
                        <div class="lebel-login">
                            <span> Or sign up with</span>
                        </div>
                        <div class="login-form">
                            <div class="btn-control-info">
                                <span><i class="fa-brands fa-google"></i></span>
                            </div>
                            <div class="btn-control-info">
                                <span><i class="fa-brands fa-facebook-f"></i></span>
                            </div>
                        </div>
                        <div class="btn-control">
                            <router-link class="btn-control-signup" to="/register-member" >Đăng ký thành viên mơi?</router-link>
                        </div>
                    </div>   
                    </div>          
                </div>
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
      
     import homeHeader from '../layout/header.vue'
     export default{
         components:{
             homeHeader
         },
         data(){
            return {
                errorList:'',
                login:{
                    email: '',
                    password: '',
                },
                passwordFieldType: "password",
                showEye:true,
                isLoading: false,
                fullPage:true,
            }
         },
         mounted(){

         },
         methods:{
            showEyePass() {
                this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
            },
             /**
              * Get data category
              * @author KietPT
              */
            loginMember(){
                this.isLoading = true;
                var mythis = this;
                axios.post('/api/login', this.login)
                .then(response =>{
                    localStorage.setItem('token', response.data.token)
                    setTimeout(() => {this.isLoading = false},2000)
                    this.$router.push({ name: "HomePage" });
                })
                .catch(function (error){
                    if(error.response){
                        if (error.response.status === false) {
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