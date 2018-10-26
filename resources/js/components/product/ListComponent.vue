<template>

    <div>
        <div class="row">
            <div class="col-auto mr-auto">
                <form action="" class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="search">
                        <button class="btn btn-success">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-auto">
                <select name="" id="" class="form-control"></select>
            </div><br><br>
        </div>
        <div class="row">
            <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" v-bind:key="product.id">
                                <td>{{product.product_id}}</td>
                                <td>{{product.name}}</td>
                                <td>{{product.stock}}</td>
                                <td>{{product.price}}</td>
                                <td>
                                    <button class="btn btn-danger">
                                        <i class="fal fa-edit"></i>
                                    </button>
                                    <button class="btn btn-warning" @click="deleteProduct(product.product_id)">
                                        <i class="fal fa-trash-alt"></i>
                                    </button>
                                    <button class="btn btn-primary" @click="showProduct(product.product_id)">
                                        <i class="fal fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data: function(){
        return {
            products: {}
        }
    },
    mounted:function(){
        this.loadProduct();
    },
    methods:{
        loadProduct: function(){
            axios.get('/product').then((data) => {
                console.log(data.data)
                this.products = data.data.data
            })
        },
        deleteProduct: function(id){
            axios.delete('/product/'+id).then((data) => {
                this.loadProduct();
            })
        },
        showProduct: function(id){
            axios.get('/product/'+id).then((data) => {
                console.log(data)
            })
        }
    }
}
</script>

<style>

</style>
