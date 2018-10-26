<template>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" v-if="success">
                Product Save
            </div>
        </div>
        <div class="col-3">
            <label for="">Image</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile file" ref="file" v-on:change="uploadImage()">
                <label class="custom-file-label" for="customFile">{{this.files.name}}</label>
            </div>
        </div>
        <div class="col-9">
            <form action="" method="" enctype="application/x-www-form-urlencoded">
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="" id="" class="form-control" v-model="form.category">
                        <option value="">Select Category</option>
                        <option v-for="category in categories" v-bind:key="category.id" v-bind:value="category.id">{{category.name}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" v-model="form.name">
                </div>
                <div class="form-group">
                    <label for="">Stock</label>
                    <input type="text" class="form-control" v-model="form.stock">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" v-model="form.price">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control" v-model="form.description"></textarea>
                </div>
                <button class="btn btn-primary" @click.prevent="createProduct()">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data: function(){
        return {
            categories: {},
            files: {
                name: 'Choose Image',
                file: ''
            },
            form:{
                category: '',
                name: '',
                stock: '',
                price: '',
                description: ''
            },
            success: false
        }
    },
    mounted: function(){
        this.loadCategory();
    },
    methods:{
        loadCategory: function(){
            axios.get('/category').then((data) => {
                this.categories = data.data
            })
        },
        uploadImage: function(){
            this.files.name = this.$refs.file.files[0].name
            this.files.file = this.$refs.file.files[0]
        },
        createProduct: function(){
            let form = new FormData();
            form.append('category_id', this.form.category);
            form.append('name', this.form.name);
            form.append('stock', this.form.stock);
            form.append('price', this.form.price);
            form.append('description', this.form.description)
            form.append('file', this.files.file)
            axios.post('/product', form, { headers:{ 'Content-Type': 'multipart/form-data' } } ).then((data) => {
                this.success = true

                this.form = {}
                this.files = {}
            })
        }
    }
}
</script>

<style>

</style>
