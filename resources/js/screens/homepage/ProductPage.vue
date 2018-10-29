<template>
    <div class="row">
        <div class="col-md-7">
            <img  v-bind:src="product.url" height="300px"/>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    {{product.name}}
                </div>
                <div class="card-body">
                    <p>RM {{product.price}}</p>
                    <div class="input-group">
                           <div class="input-group-prepend" id="button-addon3">
                                <button class="btn btn-outline-secondary" type="button" @click="addQuantity('minus')">-</button>
                            </div>
                            <input type="text" class="form-control" style="text-align: center"  v-model="quantity"  aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                            <div class="input-group-append" id="button-addon4">
                                <button class="btn btn-outline-secondary" type="button" @click="addQuantity('add')" >+</button>
                            </div>
                    </div><br>
                    <button class="btn btn-success btn-block" @click="addToCart(product.id, quantity)">Add To Cart</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <br>
            <br>
            <h3>Description</h3><hr>
            <p>{{product.description}}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data: function(){
        return{
            product: {},
            quantity: 1
        }
    },
    mounted: function(){
        this.loadProduct();
    },
    methods:{
        loadProduct: function(){
            axios.get('/product/'+this.$route.params.id).then((data) => {
                this.product = data.data
            })
        },
        addQuantity: function(type){
            if(type == 'minus'){
                if(this.quantity <= 0){
                    this.quantity = 0
                }else{
                    this.quantity -=1
                }
            }else{
                if(this.quantity >= 1 || this.quantity == 0){
                    this.quantity += 1
                }
            }
        },
        addToCart: function(id, quantity){
            let cart = localStorage.getItem('cart');
            let count = localStorage.setItem('count')
            if(cart == null){
                let array = [];
                let data = [id, quantity]
                array.push(data)
                localStorage.setItem('cart', JSON.stringify(array))
                localStorage.setItem('count', 1);
            }
        }
    }
}
</script>

<style>

</style>
