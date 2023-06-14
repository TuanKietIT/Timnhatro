<template>
    <div class="header-search" >
		        	<div class="menu-search">
		        		<div class="select-menu">
		        			<div class="search-category">
								<i class="fa-solid fa-bars"></i>
		        				<span>Danh sách phụ lục</span>
		        			</div>
							<form  method="post" class="form_input">
								<div class="input-box">
									<i class="fa-solid fa-magnifying-glass"></i>
									<input type="text" v-model="queryString" placeholder="Nhập tên bài viết..." v-on:keyup="getResult()"/>
									<div class="panel-footer" v-if="post_motels.length">
                                        <ul class="list-group">
											<li class="list-group-item" v-for="post in post_motels">
                                                <router-link :to="{ path: '/home/product/'+ post.id}" >
                                                    <p>{{ post.title }} </p>
                                                    <p>Giá: {{ formatPrice(post.price) }} VND/tháng</p>
                                                    <p>Thời gian đăng: {{ formatDate(post.created_at) }}</p>
                                               </router-link>
											</li>
										</ul>
									</div>
								</div>
							</form>
							 <div class="select-search" >
							   <a >Vị trí gần đây</a>
							 </div>
		        		</div>
		        	</div>
		        </div>
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
				login:true,
				queryString:'z',
				post_motels:[]
			}
		},
		mounted(){
            this.getInfoAdmin();
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
				   this.logout = true
				   this.login = false
                })
            },
		}
	}
</script>