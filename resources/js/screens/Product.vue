<template>
    <div>
        <div class="row">
            <div class="col-auto mr-auto">
                <h3>Products</h3>
            </div>
            <div class="col-auto">
                <button class="btn btn-light" @click="addNew">{{this.addText}}</button>
            </div>
        </div>
         <hr>
         <div class="row">
             <div class="col-12">
                 <AddNewComponent v-if="add"/>
                 <ListComponent v-if="!add"/>
             </div>
         </div>
    </div>
</template>

<script>
import AddNewComponent from '../components/product/AddNewComponent.vue';
import ListComponent from '../components/product/ListComponent.vue';
export default {
    data: function() {
        return {
            add: false,
            addText: 'Add Product'
        }
    },
    components:{
        AddNewComponent,
        ListComponent
    },
    methods:{
        addNew: function(){
            if(this.add){
                this.add = false
                this.addText = 'Add Product'
            }else{
                this.add = true
                this.addText = 'Back'
            }
        }
    }
}
</script>

<style>

</style>
