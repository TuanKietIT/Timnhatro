<template>
    <div class="main-form">
           <div class="form_login">
               <h2>Login</h2>
               <ul v-if="Object.keys(errorList).length > 0">
                    <li  style="color: red;" v-for="(error, index) in errorList" :key="index">{{ error[0] }}</li>
                 </ul>
               <form >
                   <div class="form_login-sub">
                       <input type="email" class="text"  placeholder="Enter your email" v-model="form.email" maxlength="30" />
                       <div class="form_login-icon">
                          <i class="fa-solid fa-envelope"></i>
                       </div>
                   </div>
                   <div class="form_login-sub">
                       <input type="password" class="password"  placeholder="Enter your password" maxlength="30" v-model="form.password"/>
                       <div class="form_login-icon">
                          <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                       </div>
                   </div>
                   <div class="clear"></div>
                   <div class="submit_login">
                       <span @click.prevent="login">Login</span>
                   </div>
               </form>

           </div>
       </div>
</template>

<script >
    export default{
       name:'Register',
       data(){
           return {
               errorList:'',
               form:{
                    email: 'admin@gmail.com',
                    password: 'password1',
               }
           }
       }
       ,
       methods:{
           
            /**
             * save data category
             * @author KietPT
             */
             login(){
                var mythis = this;
                axios.post('/api/sigin', this.form)
                .then(response =>{
                    localStorage.setItem('token', response.data.token)
                    this.$router.push({ name: "HomeAdmin" });

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
          
           
       }

   }
</script>
