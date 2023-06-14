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
                           <a class="active" href="#">Xác thực</a>
                       </li>
                   </ul>
               </div>
               <a href="#" class="btn-download">
                   <i class='bx bxs-cloud-download' ></i>
                   <span class="text">Download PDF</span>
               </a>
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
                                            <label class="control-label">Tên Danh mục</label>
                                            <input type="text" class="form-control" name="name" v-model="accuracy.name">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mô tả danh mục</label>
                                            <textarea name="address" id="address" cols="30" rows="4" class="form-control" v-model="accuracy.desc"></textarea>
                                        </div>
                                </div>
                                        
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn-save" v-if="showCreate" @click="saveAccuracy"> Save</button>
                                            <button class="btn-save" v-if="showUpdate"  @click="updateAccuracy"> update</button>
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
                                            <tr v-for="accuracy in accuracies" :key="accuracy.id">
                                                <td style= "color: #707070;" class="text-center">{{ accuracy.id }}</td>
                                                    <td class="">
                                                        <p>Name: <b>{{ accuracy.name }}</b></p>
                                                        <p><small>Desc: <b>{{ accuracy.desc }}</b></small></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="edit_supplier" type="button"  @click="editAccuracy(accuracy)">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn_delete" type="button"  @click="deleteAccuracy(accuracy)" >
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
               accuracies:[],
               errorList:'',
               accuracyId:'',
               accuracy:{
                   id:'',
                   name:'',
                   desc:'',
               },
               showUpdate:false,
               showCreate:true
           }
       },
       mounted(){
           this.getAccuracy();
       }
       ,
       methods:{
            /**
             * Get data accuracy
             * @author KietPT
             */
           getAccuracy(){
               axios.get('/api/accuracy')
               .then(response =>{
                    this.accuracies = response.data
                    this.id= ""
               })
           },
            /**
             * save data accuracy
             * @author KietPT
             */
           saveAccuracy(){
                var mythis = this;
                axios.post('/api/accuracy/create', this.accuracy)
                .then(response =>{
                    alert(response.data.message);
                    this.accuracy = {
                       name: "",
                       desc: "",
                   }
                   this.getAccuracy();

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
            editAccuracy(accuracy){
                this.showUpdate = true
                this.showCreate = false
                this.accuracy = accuracy
            },
            updateAccuracy(){
               var mythis = this;
               var edit = '/api/accuracy/edit/' + this.accuracy.id;
               axios.put(edit, this.accuracy)
               .then(response =>{
                   alert(response.data.message);
                   this.accuracy = {
                       name: "",
                       desc: "",
                   }
                   this.id= ""
                   this.getAccuracy();
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
            deleteAccuracy(accuracy){
                var remove = '/api/accuracy/delete/' + accuracy.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id= ""
                    this.accuracy = {
                       name: "",
                       desc: "", 
                     }
                    this.getAccuracy();
                })
            }
       }
   }
</script>
