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
					              <img  v-bind:src="'/img/' + news.image" class="tab-img" />
					        </div>
					        <div class="info-postup">
					             <h3>{{ news.name }}</h3>
                                 <p class="local">Thời gian đăng tin:{{ formatDate(news.created_at) }} </p>
					             <hr/>
                                <div class="info-desc">
                                    <h5>Thông tin mô tả</h5>
                                    <span v-html="news.description"></span>
                                </div>
                            </div>
					        <hr/>
                        </a>
                     </div>
                 </div>
                 <div class="content-right">
                     <div class="details">
                        <div class="search-news">
                            <h2>Tin tức mới nhất</h2>
                            <hr/>
                            <a v-for="items in latestNews.data" :key="items.id">
                                <router-link :to="{ path: '/news/detail/'+ items.id}">
                                    <img v-bind:src="'/img/' + items.image" alt="">
                                    <h3>{{ items.name }}</h3>
                                </router-link>
                            </a>
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
     import homeSidebar from '../layout/sidebar.vue'
     import moment from 'moment'
     import homeFooter from '../layout/footer.vue'
 
     
     export default{
         components:{
             homeHeader,homeFooter,homeSidebar
         },
         data(){
            return {
                news:[],
                newsId:'',
                latestNews:[],
                categories:[],
                users:[],
                location:[],
                moment:moment,
                dateCurent:'',
            }
         },
         mounted(){
            this.newsId = this.$route.params.id;
            this.getNewsData()
            this.getHomeCategory();
            this.getResults()
         },
         methods:{
            getNewsData(){
               var show = '/api/news/detail/' + this.newsId
               axios.get(show).then(response =>{
                    this.news = response.data.news
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
                           alert(error.response.data.message);
                       }
                   }
               })
            },
            getResults() {
                axios.get('/api/latestNews')
                .then(response => {
                    this.latestNews = response.data
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
				return moment(String(value)).format('hh:mm MM/DD/YYYY')
			},
         }
          
     }
 </script>