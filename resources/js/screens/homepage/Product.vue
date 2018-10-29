<template>
    <div>
        <div class="row">
            <div class="col-3 card-space" v-for="product in products" v-bind:key="product.id">
                <div class="card">
                    <img class="card-img-top img-fluid" v-bind:src="product.url" alt="Card image cap" height="50">
                    <div class="card-body">
                        <h5 class="card-title">{{product.name}}</h5>
                        <p class="card-text">RM {{product.price}}</p>
                        <!-- <div class="input-group">
                           <div class="input-group-prepend" id="button-addon3">
                                <button class="btn btn-outline-secondary" type="button" @click="quantities('minus', index)">-</button>
                            </div>
                            <input type="text" class="form-control" style="text-align: center"  v-bind:value="products[index].quantity" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                            <div class="input-group-append" id="button-addon4">
                                <button class="btn btn-outline-secondary" type="button" @click="quantities('add', index)">+</button>
                            </div>
                        </div><br>
                        <button class="btn btn-success btn-block">Add To Cart</button> -->
                        <button class="btn btn-primary btn-block" @click="moreInfo(product.product_id)">More Info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data: function(){
        return {
            products: {},
            quantity: 1,
        }
    },
    mounted: function(){
        this.loadProduct()
    },
    methods:{
        loadProduct: function(){
            axios.get('/product').then((data) => {
                this.products = data.data.data
            })
        },
        quantities: function(method, index){
            if (method == 'minus') {
                this.quantity -= 1,
                this.products[index].quantity -= 1

                if(this.products[index].quantity == ''){
                     this.products[index].quantity = 1
                }
            } else {
                // Vue.set(this.products[index], quantity, 10)
                if(this.products[index].quantity >= 1){
                    this.products[index].quantity += 1
                }else{
                    this.products[index].quantity = 1
                }
                // this.quantity += 1
                // 

                // if(this.products[index].quantity == ''){
                //      this.products[index].quantity = 1
                // }
            }
            console.log(this.products[index].quantity )
        },
        moreInfo: function(id){
            this.$router.push({name: 'product', params:{id: id}})
        }
    }
}
</script>

<style lang="scss">
    .card-space{
        margin-bottom: 10px;
    }
</style>
