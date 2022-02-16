<template>
    <div class="container bg-light ">
        <div class="row justify-content-center ">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header bg-success d-flex justify-content-between  align-items-center">
                        <h5 class="mb-0">Product Categories</h5>
                        <router-link :to="{name:'category-create'}" class="btn btn-warning">Create Category</router-link>

                    </div>

                    <div class="card-body bg-warning">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width:100px">Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th style="width:170px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories" :key="category.id">
                                    <td style="width:100px">{{category.id}}</td>
                                    <td> {{category.name}} </td>
                                    <td>{{category.slug}}</td>
                                    <td style="width:170px">
                                        <router-link :to=" {name:'category-edit',params:{id:category.id}} "  class="btn btn-primary btn-sm">edit</router-link>
                                        <a @click.prevent="deleteCategory(category.id)" href="#" class="btn btn-danger btn-sm">delete</a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data(){
            return{
                categories:[],
            }
        },
        methods:{
            loadCategories(){
                axios.get('/api/category').then(response =>{
                    this.categories = response.data;
                });
            },
            deleteCategory(id){
                
            axios.delete(`/api/category/${id}`).then(()=>{
                 let index = this.categories.map(data => data.id).indexOf(id);
                 this.categories.splice(index, 1);
                 this.$toaster.success("Category deleted successfully");
            });
           

        }
        },
        
        mounted() {
           // console.log('Component mounted.')
           this.loadCategories();
        }
    }
</script>
