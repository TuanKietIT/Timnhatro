<template>
     <section id="sidebar">
		<a href="#" class="brand">
            <i class='bx bxs-pyramid'></i>
			<span class="text">Team-KTQ</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">
                        <router-link to="/admin"> Quản lý </router-link>
                    </span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">
						<router-link to="/admin-location">Khu vực</router-link>
					</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">
						<router-link to="/admin-category"> Danh mục</router-link>
					</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">
						<router-link to="/admin-comment">Bình luận</router-link>
					</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-news' ></i>
					<span class="text">
						<router-link to="/admin-news">Tin tức</router-link>
					</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-news' ></i>
					<span class="text">
						<router-link to="/admin-post">Tìm bạn ở ghép</router-link>
					</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-news'></i>
					<span class="text">
						<router-link to="/admin-postMotel"> Đăng tin </router-link>
					</span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">
                        <router-link to="/admin-user"> Thành viên </router-link>
                    </span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class='bx bx-help-circle' ></i>
					<span class="text">
						<router-link to="/admin-contact"> Liên hệ </router-link>
					</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top-nave">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="#" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span @click.prevent="logout"  class="text">Đăng xuất</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->
</template>
<script >
    export default{
       name:'Sidebar',
       data(){
           return {
               errorList:'',
           }
       },
       methods:{
           
            /**
             * save data category
             * @author KietPT
             */
            logout() {
				localStorage.removeItem('token')
				this.$router.push({ name: "Login" });
			}
          
           
       }

   }
</script>