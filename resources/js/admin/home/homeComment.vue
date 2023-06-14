<template>
    <sidebarVue />
   <!-- CONTENT -->
   <section id="content">
       <headerVue />

       <!-- MAIN -->
       <main>
           <div class="head-title">
               <div class="left">
                   <ul class="breadcrumb">
                       <li>
                           <a href="#">Danh mục</a>
                       </li>
                       <li><i class='bx bx-chevron-right' ></i></li>
                       <li>
                           <a class="active" href="#">Bình luận</a>
                       </li>
                   </ul>
               </div>
           </div>
           <div class="searchbox">
                <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                    <li  style="color: red;font-size: 1.5rem;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                 </ul>
            </div>
           <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="row">
                        <!-- FORM Panel -->
                        <div class="col-md-4">
                        <form  id="manage-supplier">
                            <div class="card">
                                <div class="card-body">
                                        <input type="hidden" name="id">
                                        <div class="form-group">
                                            <label class="control-label">Id tin</label>
                                            <input type="text" class="form-control" name="name" v-model="comment.post_id">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mô tả danh mục</label>
                                            <textarea name="address" id="address" cols="30" rows="4" class="form-control" v-model="comment.description"></textarea>
                                        </div>
                                </div>
                                        
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn-save" v-if="showCreate" @click="saveComment"> Save</button>
                                            <button class="btn-save" v-if="showUpdate"  @click="updateComment"> update</button>
                                            <button class="btn-cancel" type="button" onclick="$('#manage-supplier').get(0).reset()"> Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                        <!-- FORM Panel -->
            
                        <!-- Table Panel -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <b>Danh sách danh mục</b>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Stt</th>
                                                <th class="text-center">Mô tả</th>
                                                <th class="text-center">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="comment in comments" :key="comment.id">
                                                <td style= "color: #707070;" class="text-center">{{ comment.id }}</td>
                                                    <td class="">
                                                        <p><small>Description: <b>{{ comment.description }}</b></small></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="edit_supplier" type="button"  @click="editComment(comment)">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn_delete" type="button"  @click="deleteComment(comment)" >
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <div class="container-pagination">
                                        <div class="pagination">
                                            <a href="#">&laquo;</a>
                                            <a href="#">1</a>
                                            <a class="active" href="#">2</a>
                                            <a href="#">3</a>
                                            <a href="#">4</a>
                                            <a href="#">5</a>
                                            <a href="#">6</a>
                                            <a href="#">7</a>
                                            <a href="#">&raquo;</a>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Table Panel -->
                    </div>
                </div>  
            
            </div>
                
        </main>
       <!-- MAIN -->
   </section>
</template>

<script>

   import sidebarVue from '../layout/sidebar.vue'
   import headerVue from '../layout/header.vue';
   export default{
        components:{
            sidebarVue,headerVue
        },
       data(){
           return {
               comments:[],
                errorList:'',
                commentId:'',
                comment:{
                    id:'',
                    post_id:'',
                    description:'',
                },
                showUpdate:false,
                showCreate:true
           }
       },
       mounted(){
           this.getComment();
       }
       ,
       methods:{
            /**
             * Get data comment
             * @author KietPT
             */
           getComment(){
               axios.get('/api/comment')
               .then(response =>{
                    this.comments = response.data
                    this.id= ""
               })
           },
            /**
             * save data comment
             * @author KietPT
             */
           saveComment(){
                var mythis = this;
                axios.post('/api/comment/create', this.comment)
                .then(response =>{
                    alert(response.data.message);
                    this.comment = {
                       post_id: "",
                       desc: "",
                   }
                   this.getComment();

                })
                .catch(function (error){
                    if(error.response){
                        if (error.response.status == 422) {
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
            editComment(comment){
                this.showUpdate = true
                this.showCreate = false
                this.comment = comment
            },
            updateComment(){
               var mythis = this;
               var edit = '/api/comment/edit/' + this.comment.id;
               axios.put(edit, this.comment)
               .then(response =>{
                   alert(response.data.message);
                   this.comment = {
                       post_id: "",
                       desc: "",
                   }
                   this.id= ""
                   this.getComment();
               })
               .catch(function (error){
                   if(error.response){
                       if (error.response.status == 404) {
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
            deleteComment(comment){
                var remove = '/api/comment/delete/' + comment.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id= ""
                    this.comment = {
                       post_id: "",
                       desc: "", 
                     }
                    this.getComment();
                })
            }
       }
   }
</script>
