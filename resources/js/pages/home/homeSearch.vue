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
                            <div class="postup-card">
                                <input class="input-submit" @click="room" type="submit"  value="Đăng tin ở ghép">
					        </div>
                            <div class="postup-card" v-show="showRoom">
                                <div class="custombox clearfix">
                                    <ckeditor :editor="editor" v-model="post.description"></ckeditor>
                                    <div style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary" @click="savePost">Đăng tin</button>
                                    </div>
                                </div>
					        </div>
                            <a v-for="item in posts" :key="item.id">
                                <div class="info-postup">
                                    <p class="local">Thời gian đăng tin:{{ formatDate(item.created_at) }} </p>
                                    <hr/>
                                    <div class="info-desc">
                                        <span v-html="item.description"></span>
                                    </div>
                                </div>
                                <div class="postup-card">
                                    <h5>Bình luận </h5>
                                    <span v-for="comment in comments" :key="comment">{{ comment.description }}</span>
                                    <div class="custombox clearfix">
                                        <input class="input-coment" v-model="comment.description"  type="text" placeholder="Bình luận">
                                        <div>
                                            <button type="submit" class="btn btn-primary">Gửi</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </a>
                     </div>
                 </div>
                 <div class="content-right">
                     <div class="details">
                        
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
     import Loading from 'vue3-loading-overlay';
     import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
     
     export default{
         components:{
             homeHeader,homeFooter,homeSidebar,Loading
         },
         data(){
            return {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
                moment:moment,
                dateCurent:'',
                posts:[],
                comments:[],
                showRoom: false,
                post: {
                    id:'',
                    description: ''
                },
                comment:{
                    post_id:'',
                    description: ''
                }
            }
         },
         mounted(){
            this.postId = this.$route.params.id;
            this.getData();
            this.getComment();
         },
         methods:{
            savePost() {
                let mythis = this;
                const formData = new FormData();
                formData.append('description', this.post.description);

                axios.post('/api/post/create', formData,{
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.room();
                    this.getData();
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
            room(){
                if( this.showRoom == true){
                    this.showRoom = false
                }       
                else{
                    this.showRoom = true
                }      
            },
            getData(){
               axios.get('/api/post')
               .then(response =>{
                    this.posts = response.data
                    console.log(this.posts.id)
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
                           alert(error.response.data.message);
                       }
                   }
               })
            },
            getComment(){
                var show = '/api/comment/byID'
               axios.get(show)
               .then(response =>{
                    this.comments = response.data.comment
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