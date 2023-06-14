import {createRouter, createWebHistory} from 'vue-router'

//pages
import HomePage from './pages/home/homePage.vue'
//pages Login
import HomeLogin from './pages/auth/login.vue'
//pages Register
import HomeRegister from './pages/auth/register.vue'
//pages post model
import HomePostModel from './pages/home/homePost.vue'
//pages post model
import HomeProductPostModel from './pages/home/homeProduct.vue'
//pages contact
import HomeContact from './pages/home/homeContact.vue'
//pages news
import HomeBlog from './pages/home/homeBlog.vue'
//pages Details news
import HomeNewsDetail from './pages/home/homeDetailNews.vue'
//pages Search Category id
import HomeSearchCategory from './pages/component/seachCategory.vue'
//pages Search Location id
import HomeSearchLocation from './pages/component/searchLocation.vue'
//pages Search roommates
import HomeSearchRoommate from './pages/home/homeSearch.vue'
//pages Like
import HomeLike from './pages/home/homeLike.vue'
//pages Card
import HomeCard from './pages/home/homeCard.vue'
//pages Developer
import HomeDevelop from './pages/home/homeDevelop.vue'
//admin
import HomeAdmin from './admin/home/homeAdmin.vue'
//admin category
import AdminCategory from './admin/home/homeCategory.vue'
//admin category
import AdminAccuracy from './admin/home/homeAccuracy.vue'
//admin News
import AdminNews from './admin/home/homeNews.vue'
//admin Members
import AdminMemBer from './admin/home/homeMember.vue'
//admin Location
import AdminLocation from './admin/home/homeLocation.vue'
//admin Contact
import AdminContact from './admin/home/homeContact.vue'
//admin Post Motel
import AdminPostMotel from './admin/home/homePostModel.vue'
//admin Post 
import AdminPost from './admin/home/homePost.vue'
//admin Members
import AdminComment from './admin/home/homeComment.vue'
//admin
import Login from './admin/auth/login.vue'
//error
import Error from './notFound.vue'



const routes = [
    //login
    {
        path: '/register-member',
        component: HomeRegister,
        name:'HomeRegister',
    },
     //login
     {
        path: '/login-member',
        component: HomeLogin,
        name:'HomeLogin',
    },
    //Home  development
    {
        path: '/home-development',
        component: HomeDevelop,
        name:'HomeDevelop',
    },
    //page Post model
    {
        path:'/post-model',
        name: 'HomePostModel',
        component:HomePostModel,
    },
     //page Roommate
     {
        path:'/home-roommate',
        name: 'HomeSearchRoommate',
        component:HomeSearchRoommate,
    },
    //Product Post ID
    { 
        path: '/home/product/:id',
        name: 'HomeProductPostModel',
        component: HomeProductPostModel,
    },
     //Product category ID
     { 
        path: '/home/category/:id',
        name: 'HomeSearchCategory',
        component: HomeSearchCategory,
    },
    //Product Location ID
    { 
        path: '/home/location/:id',
        name: 'HomeSearchLocation',
        component: HomeSearchLocation,
    },
    //page Post model
    {
        path:'/contact',
        name: 'HomeContact',
        component:HomeContact,
    },
    //page Card
    {
        path:'/home-card',
        name: 'HomeCard',
        component:HomeCard,
    },
    //page Like
    {
        path:'/home-like',
        name: 'HomeLike',
        component:HomeLike,
    },
     //page Blog
     {
        path:'/home-news',
        name: 'HomeBlog',
        component:HomeBlog,
    },
     //page Blog
     {
        path:'/news/detail/:id',
        name: 'HomeNewsDetail',
        component:HomeNewsDetail,
    },
    //page
    {
        path:'/',
        name: 'HomePage',
        component:HomePage,
    },
     //login
     {
        path: '/login',
        component: Login,
        name:'Login',
        meta:{
            requiresAuth:false
        }
    },
    //admin
    {
        path:'/admin',
        name: 'HomeAdmin',
        component:HomeAdmin,
        meta:{
            requiresAuth:true
        }

    },
    //admin category
    {
        path:'/admin-location',
        name: 'AdminLocation',
        component:AdminLocation,
        meta:{
            requiresAuth:true
        }

    },
    //admin comment
    {
        path:'/admin-comment',
        name: 'AdminComment',
        component:AdminComment,
        meta:{
            requiresAuth:true
        }

    },
    //admin category
    {
        path:'/admin-category',
        name: 'AdminCategory',
        component:AdminCategory,
        meta:{
            requiresAuth:true
        }

    },
    //admin Accuracy
    {
        path:'/admin-accuracy',
        name: 'AdminAccuracy',
        component:AdminAccuracy,
        meta:{
            requiresAuth:true
        }

    },
    //admin  AdminNews
    {
        path:'/admin-news',
        name: ' AdminNews',
        component: AdminNews,
        meta:{
            requiresAuth:true
        }
    },
    //admin Member
    {
        path:'/admin-user',
        name: 'AdminMemBer',
        component: AdminMemBer,
        meta:{
            requiresAuth:true
        }
    },
    //admin Contact
    {
        path:'/admin-contact',
        name: 'AdminContact',
        component: AdminContact,
        meta:{
            requiresAuth:true
        }
    },
    //admin Post Motel
    {
        path:'/admin-postMotel',
        name: 'AdminPostMotel',
        component: AdminPostMotel,
        meta:{
            requiresAuth:true
        }
    },
    //admin Post 
    {
        path:'/admin-post',
        name: 'AdminPost',
        component: AdminPost,
        meta:{
            requiresAuth:true
        }
    },
     //Error
    {
        path:'/:pathMatch(.*)*',
        name: 'Error',
        component:Error,
    }
]






const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from)=>{
    if(to.meta.requiresAuth && !localStorage.getItem('token')){
       return { name: 'Login' }
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token')){
        return { name: 'HomeAdmin' }
    } 
 })

export default router