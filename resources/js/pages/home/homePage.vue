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
						<a v-for="post in post_motels.data" :key="post.id">
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
									Thời gian đăng: {{ moment(post.created_at).fromNow(date)}}
								</span>
					            <a @click="editPostMotel(post)">
                                    <router-link  :to="{ path: '/home/product/'+ post.id}" class="btn-see" >
                                        <i class="fa-solid fa-eye"></i>
                                        Xem thêm
                                    </router-link>
					            </a>
					        </div>

					    </a>
					    <pagination :data="post_motels" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
					</div>
				</div>
				<div class="content-right">
					<div class="details">
						<div class="img">
							<span class="content-page">Tham gia chọn trọ cùng Timtro24h.com</span>
							<img class="img-page" src="../image/backgroundsearch.jpg" alt="">
							<h2 class="h2-page">Chúc bạn mai mắn tìm được trọ yêu thích nhé!!</h2>
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
               post_motels:{},
			   categories:[],
               locations:[],
			   users:[],
			   moment:moment,
			   currentPage: 1,
			   logout: false,
			   see: '',
			   id: '',
			   date: new Date(),
           }
        },
        mounted(){
           this.getResults();
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

			login(){
                this.$router.push({ name: "HomeLogin" });
			},
			getResults(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}

				// Using vue-resource as an example
				axios.get('/api/home?page=' + page)
					.then(response => {
						this.post_motels = response.data
					})
			},
			editPostMotel(post){
				this.id = post.id
				this.see = post.see + 1
				this.updateSee();
			},
			updateSee(){
                let mythis = this;
                const formData = new FormData();
                formData.append('see', this.see);
                axios.post(`/api/postmotel/updateSee/${this.id}`, formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
					this.getResults();
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
