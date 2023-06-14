<template>
    <footer>
            <div class="rows">
                <div class="col">
                	<span class="logo-info">
                		<img class="logo-1" src="../image/logo.PNG" alt="">
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
                    <li class="footer-menu">
                        <a class="a" href="">
                            <router-link to="/" class="header__navbar-icon">
                                <i class="fa-solid fa-house"></i>
                                Trang chủ
                            </router-link>	
                        </a>
                    </li>
                    <li class="footer-menu">
                        <a class="a" href="">
                            <router-link to="/home-news" class="header__navbar-icon">
								<i class="fa-regular fa-newspaper"></i>
		   	    				Tin tức
							</router-link>	
                        </a>
                    </li>
                    <li class="footer-menu">
                        <a class="a" href="">
                            <i class="fa-regular fa-newspaper"></i>
		   	    			Tìm người ở ghép
                        </a>
                    </li>
                    <li class="footer-menu">
                        <a class="a" href="">
                            <i class="fa-solid fa-star"></i>
		   	    			Yêu thích
                        </a>
                    </li>
                    <li class="footer-menu">
                        <a class="a" href="">
                            <router-link to="/contact" class="header__navbar-icon">
								<i class="fa-solid fa-envelope"></i>
		   	    				Liên hệ
							</router-link>	
                        </a>
                    </li>
                    <li class="footer-menu">
                        <a class="a" href="">
                            <router-link to="/post-model" class="header__navbar-icon">
								<i class="fa-solid fa-pen-to-square"></i>
		   	    				Đăng tin
							</router-link>
                        </a>
                    </li>

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
</template>