<template>
    <div class="container">
       <h3>Categories</h3> <hr>
       <div class="row">
           <div class="col-6">
               <table class="table">
                   <thead>
                       <tr>
                           <th>#</th>
                           <th>Name</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>
                       <tr v-for="category in categories" v-bind:key="category.id">
                           <td>{{category.id}}</td>
                           <td>{{category.name}}</td>
                           <td>
                                    <button class="btn btn-danger" @click="editCategory(category.id, category.name)">
                                        <i class="fal fa-edit"></i>
                                    </button>
                                    <button class="btn btn-warning" @click="destroyCategory(category.id)">
                                        <i class="fal fa-trash-alt"></i>
                                    </button>
                                    <button class="btn btn-primary" @click="showCategory(category.id)">
                                        <i class="fal fa-eye"></i>
                                    </button>
                            </td>
                       </tr>
                   </tbody>
               </table>
           </div>
           <div class="col-6">
               <div class="card">
                   <div class="card-header">
                       <a href="" class="card-title">Add New</a>
                   </div>
                   <div class="card-body">
                       <form action="" class="form-inline">
                           <div class="form-group">
                               <input type="text" class="form-control" v-model="name">
                               <button class="btn btn-dark" v-if="!id" @click.prevent="addCategory">Save</button>
                               <button class="btn btn-dark" v-if="id" @click.prevent="updateCategory">Update</button>
                            </div>
                       </form>
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
            id: '',
            name: '',
            categories: {}
        }
    },
    mounted:function(){
        this.loadCategory()
    },
    methods:{
        addCategory: function(){
            let form = new FormData();
            form.append('name', this.name)

            axios.post('/category', form).then((data) => {
                this.loadCategory();
                this.name = ''
            })
        },
        loadCategory: function(){
            axios.get('/category').then((data) => {
                this.categories = data.data
            })
        },
        showCategory: function(id){
            axios.get('/category/'+id).then((data) => {
                console.log(data.data)
            })
        },
        editCategory: function(id, name){
            this.name = name
            this.id = id
        },
        updateCategory: function(){
            let form = new FormData();
            form.append('name', this.name)

            axios.put('/category/'+this.id, {name: this.name}).then((data) => {
                this.loadCategory();
                this.name = ''
                this.id = ''
            })
        },
        destroyCategory: function(id){
            axios.delete('/category/'+id).then((data) => {
                this.loadCategory();
            })
        }
    }
}
</script>

<style>

</style>
