<template>
    <div>
        <div class="row">
            <div class="col-3 card-space" v-for="product in products" v-bind:key="product.id">
                <div class="card">
                    <img class="card-img-top img-fluid" v-bind:src="product.url" alt="Card image cap" height="50">
                    <div class="card-body">
                        <h5 class="card-title">{{product.name}}</h5>
                        <p class="card-text">RM {{product.price}}</p>
                        <div class="input-group">
                            <div class="input-group-prepend" id="button-addon3">
                                <button class="btn btn-outline-secondary" type="button" @click="quantities('minus')">-</button>
                            </div>
                            <input type="text" class="form-control" style="text-align: center" v-model="quantity" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
                            <div class="input-group-append" id="button-addon4">
                                <button class="btn btn-outline-secondary" type="button" @click="quantities('add')">+</button>
                            </div>
                        </div><br>
                        <button class="btn btn-success btn-block">Add To Cart</button>
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
        this.loadProduct(this.$route.params.id)
    },
    updated: function(){
        this.loadProduct(this.$route.params.id)
    },
    methods:{
        loadProduct: function(id){
            axios.get('/category/'+id).then((data) => {
                this.products = data.data
            })
        },
        quantities: function(method){
            if (method == 'minus') {
                this.quantity -= 1
            } else {
                this.quantity += 1
            }
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
