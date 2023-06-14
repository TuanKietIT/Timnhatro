<template>
    <div class="modal">
         <div class="modal__display">
 
         </div>
         <div class="modal__body">
             <div class="form__center">
               <h1>Create add event</h1>
               <span @click.prevent="closeModal"><i class='bx bx-message-alt-x' ></i></span>
             </div>
             <ul class="alert alert-warning"  v-if="Object.keys(errorList).length > 0">
                    <li  style="color: red;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                 </ul>
             <div class="modal__body__form">
                 <form action="" @submit.prevent="saveData()">
                     <div class="form__create">
                        <span for="">Title</span>
                        <input   type="text" >
                     </div>
                     <div class="form__create">
                        <span for="">bắt đầu</span>
                        <input class="form-control"  type="datetime-local" />
                     </div>
                     <div class="form__create">
                        <span for="">kết thúc</span>
                        <input class="form-control" type="datetime-local" />
                     </div>
                      <div class="form__create">
                         <span for="">Color</span>
                         <select name=""  id="">
                            <option value="" selected disabled hidden>Color</option>
                            <option class="red-color" value=" #ff4d4d">red</option>
                            <option class="green-color" value="#33ff77">green</option>
                            <option class="Yellow-color" value="#ffff66">Yellow</option>
                            <option class="blue-color" value="#00bfff">blue</option>
                         </select>
                     </div>
                    
                      <div class="form__create">
                           <span for="">Thời gian</span>
                           <select >
                             <option disabled value="">Chọn thời gian</option>
                             <option value="Bận">Bận</option>
                             <option value="Rảnh">Rảnh</option>
                           </select>
                      </div>
                       <div class="form__create">
                           <span for="">Chế độ </span>
                           <select>
                             <option disabled value="">Chọn chế độ</option>
                             <option value="Công khai">Công khai</option>
                             <option value="Riêng tư">Riêng tư</option>
                           </select>
                       </div>
                       <div class="form__create">
                          <button  class="create">Create</button>
                          <button class="edit" >Edit</button>
                          <button class="delete">Delete</button>
                       </div>
                 </form>
             </div>
         </div>
    </div>
 </template>
 <script>

      export default {
      name:"Modal",
      data(){
           return {
               errorList:'',
               news:[],
           }
       },
 
   }
 </script>