<template>
    <div class="search-catagory">
        <h2 @click="show1" > <i class="fa-solid fa-filter"></i> Lọc Theo danh mục</h2>
        <a v-show="showCategogy" v-for="cate in categories" :key="cate.id">
            <router-link :to="{ path: '/home/category/'+ cate.id}" class="btn-see" >
                <h3>{{ cate.name }}</h3>
            </router-link>
            </a>
        <h2 @click="show2"> <i class="fa-solid fa-filter"></i> Lọc khu vực</h2>
        <a v-show="showLocation" v-for="locate in locations" :key="locate.id">
            <router-link :to="{ path: '/home/location/'+ locate.id}" class="btn-see" >
                <h3>{{ locate.name }}</h3>
            </router-link>
            </a>
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
			   showCategogy:false,
			   showLocation:false,
               categories:[],
               locations:[],	
                
			}
		},
		mounted(){
			this.post_motels = ''
            this.getHomeCategory();
            this.getHomeLocation();
		},
		methods:{
            show1(){
                if(this.showCategogy == true){
					this.showCategogy = false
				}
				else{
					this.showCategogy = true
				}
			},
			show2(){
                if(this.showLocation == true){
					this.showLocation = false
				}
				else{
					this.showLocation = true
				}
			},
            getHomeLocation(){
                axios.get('/api/showLocation')
                .then(response =>{
                     this.locations = response.data
                })
            },
            getHomeCategory(){
                axios.get('/api/showcategory')
                .then(response =>{
                     this.categories = response.data
                })
            },
		}
	}
</script>