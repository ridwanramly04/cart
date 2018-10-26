<template>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <ul class="list-group">
                    <li class="list-group-item">
                        <router-link to="/">Products</router-link>
                    </li>
                    <li class="list-group-item">
                        <router-link to="/category">Categories</router-link>
                    </li>
                    <li class="list-group-item">
                        <router-link to="/order">Orders</router-link>
                    </li>
                </ul>
            </div>
            <div class="col-10 box">
                  <router-view name="dashboard"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">
    .box{
        background: #fff;
        border-radius: 10px;
        padding-top: 20px;
        padding-bottom: 20px;
    }
</style>
