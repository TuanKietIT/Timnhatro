<template>
    <header class="header-nav">
		    <div class="grid">
		   	    <div class="header__navbar">
		   	    	<div class="header__navbar-list">
		   	    		<span class="header__navbar-item header__navbar-space">
		   	    			<span>Tìm kiếm nhà trọ sinh viên</span>
		   	    		</span>
		   	    		<span class="header__navbar-item">
		   	    			<a class="header__navbar-icon" href="">
						    	Kết nối
						    	<i class="fa-brands fa-facebook"></i>
						    </a>
		   	    		</span>
		   	    	</div>
		   	    	<div class="header__navbar-list">
		   	    		<span class="header__navbar-item header__navbar-space">
		   	    			<a class="header__navbar-icon" href="">
						       <span> Thông báo</span>
		   	    			   <i class="fa-solid fa-bell"></i>
						    </a>
		   	    		</span>
		   	    		<span class="header__navbar-item" v-show="logout">
						    <a class="header__navbar-icon"  @click.prevent="logoutUser">
								Đăng Xuất
								<i class="fa-solid fa-right-from-bracket"></i>
							</a>
		   	    		</span>
						<span class="header__navbar-item" v-show="login">
							<router-link to="/login-member" class="header__navbar-icon">
								Đăng Nhập
								<i class="fa-solid fa-right-from-bracket"></i>
							</router-link>
						</span>
		   	    	</div>
		        </div>
		        <div class="header_nav">
		   	    	<nav>
		   	    		<a class="image_center" href="">
		   	    			<img class="logo" src="../image/logo.PNG" alt="">
		   	    			<span>TimTro24h.com</span>
		   	    		</a>
		   	    		<ul>
		   	    			<li>
		   	    				<a >
									<router-link to="/" class="header__navbar-icon">
										<i class="fa-solid fa-house"></i>
		   	    					    Trang chủ
									</router-link>	
		   	    				</a>
		   	    			</li>
		   	    			<li>
		   	    				<a >
									<router-link to="/home-news" class="header__navbar-icon">
										<i class="fa-regular fa-newspaper"></i>
		   	    					    Tin tức
									</router-link>	
		   	    				</a>
		   	    			</li>
		   	    			<li>
		   	    				<a >
									<router-link to="/home-roommate" class="header__navbar-icon">
										<i class="fa-regular fa-newspaper"></i>
		   	    					    Tìm người ở ghép
									</router-link>	
		   	    				</a>
		   	    			</li>
		   	    			<li>
		   	    				<a >
									<router-link to="/home-like" class="header__navbar-icon">
										<i class="fa-solid fa-star"></i>
		   	    					    Yêu thích
									</router-link>	
		   	    				</a>
		   	    			</li>
		   	    			<li>
		   	    				<a >
									<router-link to="/contact" class="header__navbar-icon">
										<i class="fa-solid fa-envelope"></i>
		   	    				        Liên hệ
									</router-link>	
		   	    			   </a>
		   	    			</li>
							<li>
		   	    				<a >
									<router-link to="/home-development" class="header__navbar-icon">
										<i class="fa-solid fa-heart"></i>
		   	    				        Giải pháp cuối cùng
									</router-link>	
		   	    			   </a>
		   	    			</li>
		   	    			<li>
								<router-link to="/post-model" class="header__navbar-icon">
									<i class="fa-solid fa-pen-to-square"></i>
		   	    					Đăng tin
							    </router-link>
		   	    			</li>
							<li v-show="showNameUse">
								<i class="fa-solid fa-circle-user"></i>
								<span class="name-user">{{ name }}</span>
		   	    			</li>
		   	    		</ul>
		   	    		<img class="avata" src="../image/avata.jpg" >
		   	    	</nav>
		        </div>
		        <section class="big-image">
			        <div class="big-image-content">
			           <img src="../image/background.jpg" alt="">
			           <div class="content-image">
				        	<h2>
				        		TimTro24h.com
				        	</h2>
				        	<span>
				        		<img class="logo-1" src="../image/logo.png" alt="">
				        	</span>
							<marquee>
								<p >Kinh doanh trong hạnh phúc. Chúc bạn mai mắn lựa được nơi yêu thích</p>
							</marquee>
				        </div>
				        <div class="image-right">
				        	<span>
				        	     <h3>Lựa chọn yêu thích </h3>
				        	     <p>Tôi tin bạn <i class="fa-solid fa-face-smile"></i></p>
				        	     <span>Chốt trọ thoi !!!</span>
				        	</span>
				        </div>
				        <div class="slow-left">
				        	<span>
				        	     <h3>Thảnh thơi chọn trọ </h3>
				        	     <p>giá rẻ khỏi lo <i class="fa-solid fa-face-smile"></i></p>
				        	     <span>Tìm ngay là có !!!</span>
				        	</span>
				        </div>
			        </div>
			    </section>
		        
            </div>
		</header>
</template>

<script>
import moment from 'moment'
    export default{
		props:{
			type: Object,
			default: () =>{}
		},
		data(){
			return{
                logout: false,
				name:'',
				login:false,
				queryString:'',
				post_motels:[],
				showNameUse:false
			}
		},
		mounted(){
            this.getInfoAdmin();
			this.post_motels = ''
			this.getData()
		},
		methods:{
			formatPrice(value) {
				let val = (value/1).toFixed(0).replace('.', ',')
				return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			},
			formatDate(value) {
				return moment(String(value)).format('hh:mm MM/DD/YYYY')
			},
			logoutUser(){
                localStorage.removeItem('token')
				this.$router.push({ name: "HomePage" }); 
				this.getData();
				this.getInfoAdmin()
			},
			getData(){
                const token = localStorage.getItem('token');
				if(token){
                   this.logout = true
				   this.login = false
				   this.showNameUse = true
				}
				else{
					this.login = true
					this.logout = false
					this.showNameUse = false
				}
			},
			getResult(){
				axios.get('/api/search',{params: {queryString: this.queryString}})
                .then(response => {
					this.post_motels = response.data
                })
			},
            getInfoAdmin(){
                const token = localStorage.getItem('token');
                axios.get('/api/user',{
                    headers:{
                        Authorization: ' Bearer ' + token
                    }
                })
                .then(response => {
                   this.name = response.data[0].name;
                })
            },
		}
	}
</script>