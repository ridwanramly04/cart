<template>
    <div class="row">
        <div class="col-3 sidebar">
            <h3>Category</h3><hr>
            <ul class="list-group">
                <li class="list-group-item">
                    <router-link to="/"><i class="far fa-shopping-cart"></i> Cart (0)</router-link>
                </li>
                <li class="list-group-item">
                    <router-link to="/">All</router-link>
                </li>
                <li class="list-group-item" v-for="category in categories" v-bind:key="category.id">
                  <router-link :to="{name:'category', params:{id: category.id}}">{{category.name}}</router-link>
                </li>
            </ul>
        </div>
        <div class="col-8 shopping shadow-sm  bg-white rounded">
            <h3>Products</h3><hr>
            <router-view name="homepage"></router-view>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data: function(){
        return {
            categories: {}
        }
    },
    mounted:function(){
        this.loadCategories();
    },
    methods:{
        loadCategories: function(){
            axios.get('/category').then((data) => {
                this.categories = data.data
            })
        }
    }
}
</script>

<style lang="scss">
    .shopping{
        background-color: #ffffff;
        border-radius: 10px;
        padding-top: 20px;
        padding-left: 20px;
        padding-bottom: 20px;
    }
    .sidebar{
         padding-top: 20px;
    }
</style>
