<template>
    <div class="app">
        <homeHeader/>
         <div class="container">
             <div class="section">
                 <div class="content-left">
                    <div class="category">
                        
                     </div>
                     <div class="content-detail">
                        <div class="contact-user">
                            <div class="box-content">
                                <div class="contact form">
                                    <h3>Trang Thanh toán</h3>
                                    <form  enctype="multipart/form-data">
                                        <div class="form-box">
                                            <span style="width: 100%;font-size: 18px; margin: 20px 0;">Bạn hãy nhập vào số lượng ngày để chúng tôi đưa ra số tiền thanh toán</span>
                                            <div class="row10" style="margin-top: 20px;margin-bottom: 20px;">
                                                <input type="checkbox" v-model="checkDate7" v-show="check7" placeholder=""><span style="font-size: 18px;">Gói gồm 7 ngày</span>
                                            </div>
                                            <div class="row10" style="margin-top: 20px;margin-bottom: 20px;">
                                                <input type="checkbox" v-model="checkDate14" v-show="check14" placeholder=""><span style="font-size: 18px;">Gói gồm 14 ngày</span>
                                            </div>
                                            <div class="row10" style="margin-top: 20px;margin-bottom: 20px;">
                                                <input type="checkbox" v-model="checkDate30" v-show="check30" placeholder=""><span style="font-size: 18px;">Gói gồm 30 ngày</span>
                                            </div>
                                            <div class="row100">
                                                <button @click.prevent="check">Kiểm tra</button>
                                            </div>
                                            <div class="row100" style="margin-top: 20px;margin-bottom: 20px;">
                                                <div class="input-info">
                                                    <span style="width: 100%;font-size: 18px; padding: 10px 0;">Số tiền bạn cần thanh toán !</span>
                                                    <input type="text" disabled v-model="product.price"  placeholder="">
                                                    <i class="fa-solid fa-pen-to-square icon-contact"></i>
                                                </div>
                                            </div>
                                            <div class="row100" >
                                                <div ref="paypal"></div>
                                            </div>
                                        </div>   
                                    </form>
                                </div>
                            </div>
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
     import moment from 'moment'
     import homeFooter from '../layout/footer.vue'
 
     
     export default{
         components:{
             homeHeader,homeFooter
         },
         data(){
            return {
                pay:{
                   amount:""
                },
                checkDate7:false,
                checkDate14:false,
                checkDate30:false,
                check7:true,
                check14:true,
                check30:true,
                product: {
                    price: "",
                    description: "leg lamp from that one movie",
                }
                
            }
         },
         mounted(){
            this.getGetData()
            const script = document.createElement("script");
            script.src =
            "https://www.paypal.com/sdk/js?client-id=AbVTbhf6HRYLSio8lHAjzxhw6dMYeh_I9r014tgzDZi8jE2emnvAX1g3XaT100qOeVC63MEPpNzw_13j";
            script.addEventListener("load", this.setLoaded);
            document.body.appendChild(script);
         },
         methods:{
            setLoaded: function() {
                this.loaded = true;
                window.paypal
                    .Buttons({
                    createOrder: (data, actions) => {
                        return actions.order.create({
                        purchase_units: [
                            {
                            description: this.product.description,
                            amount: {
                                currency_code: "USD",
                                value: this.product.price
                            }
                            }
                        ]
                        });
                    },
                    onApprove: async (data, actions) => {
                        const order = await actions.order.capture();
                        this.paidFor = true;
                        console.log(order);
                    },
                    onError: err => {
                        console.log(err);
                    }
                    })
                    .render(this.$refs.paypal);
            },
            check(){
                this.getGetData();
            },
            getGetData(){
                let checkDate7 = this.checkDate7
                let checkDate14 = this.checkDate14
                let checkDate30 = this.checkDate30
                if(checkDate7 == true){
                     this.product.price = 15000
                     this.check14 = false
                     this.check30 = false
                }
                else if(checkDate14 == true){
                     this.product.price = 25000
                     this.check7 = false
                     this.check30 = false
                }
                else if(checkDate30 == true){
                     this.product.price = 50000
                     this.check7 = false
                     this.check14 = false
                }
                else{
                    this.check7 = true
                    this.check14 = true
                    this.check30 = true
                }
                
            },
            payMent(){
                var mythis = this;
                axios.post('/api/pay', this.pay)
                .then(response =>{
                    alert(response.data.message);

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
         }
          
     }
 </script>

