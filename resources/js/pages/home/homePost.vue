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
                        <div class="contact-user">
                            <div class="box-content">
                                <div class="contact form">
                                    <h3>Đăng tin mới</h3>
                                    <hr/>
                                    <form  enctype="multipart/form-data">
                                        <div class="form-box">
                                            <div class="row100" style="margin-top: 20px;margin-bottom: 20px;">
                                                <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.title"></span>
                                                <div class="input-info">
                                                    <input type="text" v-model="post.title"  placeholder="Tên bài viết *">
                                                    <i class="fa-solid fa-pen-to-square icon-contact"></i>
                                                </div>
                                            </div>
                                            <div class="row10">
                                                <div class="input-info">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.price"></span>
                                                    <input type="text" v-model="post.price" placeholder="Giá* (gõ số)">
                                                </div>
                                                <div class="input-info">  
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.deposit"></span>  
                                                    <input type="text" v-model="post.deposit"  placeholder="Giá cọc* (gõ số)" >
                                                </div>
                                            </div>
                                            <div class="row10">
                                                <div class="input-info">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.area"></span>  
                                                    <input type="text" v-model="post.area"  placeholder="Diện tích (gõ số)" >
                                                </div>
                                                <div class="input-info" >
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.purpose"></span> 
                                                    <select v-model="post.purpose">
                                                        <option disabled value="">Mục đích *</option>
                                                        <option value="Cho thuê">Cho thuê</option>
                                                        <option value="Cho thuê">Mua bán</option>
                                                        <option value="Cho thuê">Sang nhượng</option>
                                                        <option value="Pass lại phòng">Pass lại phòng</option>
                                                        <option value="Chuyển trọ">Chuyển trọ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row10">
                                                <div class="input-info">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.category_id"></span>
                                                    <select v-model="post.category_id" >
                                                        <option disabled value="">Chọn danh mục *</option>
                                                        <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>
                                                    </select>
                                                </div>
                                                <div class="input-info">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.location_id"></span>
                                                    <select  v-model="post.location_id">
                                                        <option disabled value="">Chọn Khu vực*</option>
                                                        <option :value="locate.id" v-for="locate in locations" :key="locate.id">{{locate.name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row10">
                                                <div class="input-info">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.status"></span>
                                                    <select name="vitri_use" v-model="post.status" id="">
                                                        <option disabled value="">Chọn Trạng thái*</option>
                                                        <option value="Phòng trống">Phòng trống</option>
                                                        <option value="Đang sửa chửa">Đang sửa chửa</option>
                                                        <option value="Nhận phòng vào cuối tháng">Nhận phòng vào cuối tháng</option>
                                                    </select>
                                                </div>
                                                <div class="input-info">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.structure"></span>
                                                    <select name="vitri_use" v-model="post.structure" id="">
                                                        <option disabled value="">Chọn kết cấu*</option>
                                                        <option value="Có gác">Có gác</option>
                                                        <option value="Không có gác">Không có gác</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row100">
                                                <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.address_address"></span>
                                                <div class="input-info">
                                                    <input type="text" v-model="post.address_address" id="location" name="diachi" placeholder="Địa chỉ">
                                                    <i class="fa-solid fa-magnifying-glass search-location" @click="LocationSearch"></i>
                                                </div>
                                            </div>
                                            <div class="row100">
                                                <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.description"></span>
                                                <ckeditor :editor="editor" v-model="post.description" :config="editorConfig"></ckeditor>
                                            </div>
                                            <div class="row10">
                                                <div class="input-file">
                                                    <span style="font-size: 15px;color:rgb(222, 15, 15);" v-html="errorList.file1"></span>
                                                    <input type="file"  v-on:change="onChangeImage1" >
                                                    <div  v-if="post.img1">
                                                        <img v-bind:src="imgPreview" style="margin-left: 30px;" width="180" height="100"/>
                                                    </div>
                                                </div>
                                                <div class="input-file" v-show="chooseImage2">
                                                    <input type="file" v-on:change="onChangeImage2" >
                                                    <div  v-if="post.img2">
                                                        <img v-bind:src="imgPreview2" style="margin-left: 30px;" width="180" height="100"/>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row10">
                                                <div class="input-file" v-show="chooseImage3">
                                                    <input type="file"  v-on:change="onChangeImage3" >
                                                    <div  v-if="post.img3">
                                                        <img v-bind:src="imgPreview3" width="180" style="margin-left: 30px;" height="100"/>
                                                    </div>
                                                </div>
                                                <div class="input-file" v-show="chooseImage4">
                                                    <input type="file"  v-on:change="onChangeImage4" >
                                                    <div  v-if="post.img4">
                                                        <img v-bind:src="imgPreview4" width="180" style="margin-left: 30px;" height="100"/>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row10" style="margin-bottom: 100px;">
                                                <div class="input-file" v-show="chooseImage5">
                                                    <input type="file"  v-on:change="onChangeImage5">
                                                    <div  v-if="post.img5">
                                                        <img v-bind:src="imgPreview5" style="margin-left: 30px;" width="180" height="100"/>
                                                    </div>
                                                </div>
                                                <div class="input-file" v-show="chooseImage6">
                                                    <input type="file"  v-on:change="onChangeImage6">
                                                    <div  v-if="post.img6">
                                                        <img v-bind:src="imgPreview6" width="180" style="margin-left: 30px;" height="100"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row100">
                                                <div class="input-info">
                                                    <button @click.prevent="savePostModel">Đăng tin</button>
                                                </div>
                                            </div>
                                        </div>   
                                    </form>
                                    <Loading :active="isLoading" 
                                        :can-cancel="true" 
                                        :is-full-page="fullPage"></Loading> 
                                </div>
                            </div>
                        </div>
                     </div>
                 </div>
                 <div class="content-right">
                   
                 </div>
             </div>
         </div>
         <homeFooter/>
     </div>
 </template>
 
 <script>
      
     import homeHeader from '../layout/header.vue'
     import homeSidebar from '../layout/sidebar.vue'
     import { QuillEditor } from '@vueup/vue-quill'
     import '@vueup/vue-quill/dist/vue-quill.snow.css';
     import Loading from 'vue3-loading-overlay';
     import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import homeFooter from '../layout/footer.vue'
     import flatpickr from "flatpickr";
     export default{
         components:{
             homeHeader,QuillEditor,Loading,homeFooter,homeSidebar
         },
         data(){
            return {
                editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
                chooseImage2: false,
                chooseImage3: false,
                chooseImage4: false,
                chooseImage5: false,
                chooseImage6: false,
                imgPreview:null,
                imgPreview2:null,
                imgPreview3:null,
                imgPreview4:null,
                imgPreview5:null,
                imgPreview6:null,
                categories:[],
                locations:[],
                isLoading: false,
                fullPage:true,
                post:{
                    title:"",
                    price:"",
                    purpose:"",
                    status:"",
                    deposit:"",
                    structure:"",
                    description:"",
                    area:"",
                    img1:"null",
                    img2:"null",
                    img3:"null",
                    img4:"null",
                    img5:"null",
                    img6:"null",
                    address_address:"",
                    address_latitude:"10.787554",
                    address_longitude:"106.6407684  ",
                    category_id:"",
                    location_id:"",
                    user_id: "",
                    choose: 0
                },
                errorList:'',
                showSubMenu:false,
                editorOption:{
                    placeholder: 'core',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ header: 1 }, { header: 2 }],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ script: 'sub' }, { script: 'super' }],
                            [{ indent: '-1' }, { indent: '+1' }],
                            [{ direction: 'rtl' }],
                            [{ size: ['small', false, 'large', 'huge'] }],
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            [{ color: [] }, { background: [] }],
                            [{ font: [] }],
                            [{ align: [] }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ]
                    }
                }
            }
         },
         mounted(){
            this.getHomeCategory();
            this.getHomeLocation();
            this.getInfoData();
            this.getInfoAdmin()
         },
         setup() {
            flatpickr("input[type=datetime-local]", {});
        },
         methods:{
            getHomeCategory(){
                axios.get('/api/showcategory')
                .then(response =>{
                     this.categories = response.data
                })
            },
            getHomeLocation(){
                axios.get('/api/showLocation')
                .then(response =>{
                     this.locations = response.data
                })
            },
            savePostModel(){
                this.isLoading = true
                var mythis = this;
                const token = localStorage.getItem('token');
                const formData = new FormData();
                formData.append('title', this.post.title);
                formData.append('price', this.post.price);
                formData.append('purpose', this.post.purpose);
                formData.append('status', this.post.status);
                formData.append('deposit', this.post.deposit);
                formData.append('structure', this.post.structure);
                formData.append('description', this.post.description);
                formData.append('area', this.post.area);
                formData.append('file1', this.post.img1);
                formData.append('file2', this.post.img2);
                formData.append('file3', this.post.img3);
                formData.append('file4', this.post.img4);
                formData.append('file5', this.post.img5);
                formData.append('file6', this.post.img6);
                formData.append('address_address', this.post.address_address);
                formData.append('address_latitude', this.post.address_latitude);
                formData.append('address_longitude', this.post.address_longitude);
                formData.append('category_id', this.post.category_id);
                formData.append('location_id', this.post.location_id);
                formData.append('user_id', this.post.user_id);
                formData.append('choose', this.post.choose);
                axios.post('/api/postmotel/create', formData,{
                    headers:{
                        Authorization: ' Bearer ' + token
                    }
                })
                .then(response =>{
                    alert(response.data.message);
                    this.isLoading = false
                    this.$router.push({ name: "HomeCard" });
                })
                .catch(function (error){
                    if(error.response){
                        if (error.response.status === 422) {
                            mythis.errorList = error.response.data.errors;
                            mythis.isLoading = false
                        }
                        else if (error.response.status === 400) {
                            console.log(error.response.data.error)
                        }
                        else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    }
                })
            },
            getInfoData(){
                axios.get('/api/show')
                .then(response => {
                    this.categories = response.data.categoris;
                    this.locations = response.data.locations
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
                    this.post.user_id = response.data[0].id
                })
            },
            onChangeImage1(e) {
                this.post.img1 = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview = reader.result;
                }.bind(this), false);

                if (this.post.img1) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.post.img1.name ) ) {
                        reader.readAsDataURL( this.post.img1 );
                    }
                }
                this.chooseImage2 = true
            },
            onChangeImage2(e) {
                this.post.img2 = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview2 = reader.result;
                }.bind(this), false);

                if (this.post.img2) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.post.img2.name ) ) {
                        reader.readAsDataURL( this.post.img2 );
                        this.upload2 = true
                    }
                }
                this.chooseImage3 = true
            },
            onChangeImage3(e) {
                this.post.img3 = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview3 = reader.result;
                }.bind(this), false);

                if (this.post.img3) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.post.img3.name ) ) {
                        reader.readAsDataURL( this.post.img3 );
                    }
                }
                this.chooseImage4 = true
            },
            onChangeImage4(e) {
                this.post.img4 = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview4 = reader.result;
                }.bind(this), false);

                if (this.post.img4) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.post.img4.name ) ) {
                        reader.readAsDataURL( this.post.img4 );
                    }
                }
                this.chooseImage5 = true
            },
            onChangeImage5(e) {
                this.post.img5 = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview5 = reader.result;
                }.bind(this), false);

                if (this.post.img5) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.post.img5.name ) ) {
                        reader.readAsDataURL( this.post.img5 );
                    }
                }
                this.chooseImage6 = true
            },
            onChangeImage6(e) {
                this.upload6 = false
                this.post.img6 = e.target.files[0];
                let reader = new FileReader();
                reader.addEventListener("load", function () {
                    this.imgPreview6 = reader.result;
                }.bind(this), false);

                if (this.post.img6) {
                    if ( /\.(jpe?g|png|gif)$/i.test( this.post.img6.name ) ) {
                        reader.readAsDataURL( this.post.img6 );
                    }
                }
            },
              LocationSearch(){
                   if(navigator.geolocation){
                      navigator.geolocation.getCurrentPosition(position => {
                            this.GetAndLatLong(position.coords.latitude,position.coords.longitude)
                        },
                        error =>{
                            console.log(error.message)
                        }
                      );
                   }
                   else{
                       console.log("Bạn không thể kết nói được vơi api google maps")
                   }
              },
              GetAndLatLong(lat,long){
                  axios.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + long + "&key=AIzaSyAIBoH2XekLmOnqi33ZWglL_Hn_4hAlmXk").then(response=>{
                      if(response.data.error_message)
                      {
                         console.log(response.data.error_message);
                      }
                      else{
                        console.log(response.data.results[0].formatted_address);
                      }
                  })
                  .catch(error =>{
                     console.log(error.message);
                  })
              },
             /**
              * Get data category
              * @author KietPT
              */
         }
          
     }
 </script>