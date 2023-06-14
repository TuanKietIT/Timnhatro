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
                           <a href="#">Dashboard</a>
                       </li>
                       <li><i class='bx bx-chevron-right' ></i></li>
                       <li>
                           <a class="active" href="#">Khu vực</a>
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
                                            <label class="control-label">Tên Danh mục</label>
                                            <input type="text" class="form-control" name="name" v-model="location.name">
                                        </div>
                                </div>
                                        
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn-save" v-show="showCreate" @click="saveLocation"> Save</button>
                                            <button class="btn-save" v-show="showUpdate"  @click="updateLocation"> update</button>
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
                                            <tr v-for="location in locations.data" :key="location.id">
                                                <td style= "color: #707070;" class="text-center">{{ location.id }}</td>
                                                    <td class="">
                                                        <p>Name: <b>{{ location.name }}</b></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="edit_supplier" type="button"  @click="editLocation(location)">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </button>
                                                        <button class="btn_delete" type="button"  @click="deleteLocation(location)" >
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <div class="container-pagination">
                                        <pagination :data="locations" v-bind:showDisabled="true" icon="chevron" v-on:change-page="getResults"></pagination>
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
   import headerVue from '../layout/header.vue'
   import pagination from 'laravel-vue-semantic-ui-pagination'
   export default{
        components:{
            sidebarVue,headerVue, pagination
        },
       data(){
           return {
               locations:[],
               errorList:'',
               locationId:'',
               location:{
                   id:'',
                   name:''               
                },
                currentPage: 1,
               showUpdate:false,
               showCreate:true
           }
       },
       mounted(){
           this.getResults();
       }
       ,
       methods:{
            /**
             * Get data location
             * @author KietPT
             */
            getResults(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}

				// Using vue-resource as an example
				axios.get('/api/location?page=' + page)
				.then(response => {
						this.locations = response.data
				})
			},
            /**
             * save data location
             * @author KietPT
             */
           saveLocation(){
                var mythis = this;
                axios.post('/api/location/create', this.location)
                .then(response =>{
                    this.getLocation();
                    this.location = {
                        name: ""
                    }

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
            editLocation(location){
                this.showUpdate = true
                this.showCreate = false
                this.location = location
            },
            updateLocation(){
               var mythis = this;
               var edit = '/api/location/edit/' + this.location.id;
               axios.put(edit, this.location)
               .then(response =>{
                   this.location = {
                       name: "",
                   }
                   this.id=""
                   this.getLocation();
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
            deleteLocation(location){
                var remove = '/api/location/delete/' + location.id;
                axios.delete(remove)
                .then(response =>{
                    alert(response.data.message);
                    this.id=""
                    this.getLocation();
                })
            }
       }
   }
</script>
