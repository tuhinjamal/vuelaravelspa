<template>
    <div class="container bg-light ">
        <div class="row justify-content-center ">
            <div class="col-md-16">
                <div class="card">
                    <div class="card-header bg-success d-flex justify-content-between  align-items-center">
                        <h5 class="mb-0">Product List</h5>
                        <router-link :to="{name:'product-create'}" class="btn btn-warning">Create Product</router-link>

                    </div>

                    <div class="card-body bg-warning">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th >Id</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th > Image</th>
                                    <th style="width:170px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td>{{product.id}}</td>
                                    <td> {{product.title}} </td>
                                    <td>{{product.slug}}</td>
                                    <td>{{product.price}}</td>
                                    <td>{{product.description}}</td>
                                    <td>
                                        
                                    <div style="max-width:150px; max-height:150px; overflow:hidden">
                                        <img class="img-fluid" :src="'/storage/product/'+product.image" alt="product">
                                    </div>
                                    </td>
                                    <td style="width:170px">
                                        <router-link :to=" {name:'product-edit',params:{id:product.id}} "  class="btn btn-primary btn-sm">edit</router-link>
                                        <a @click.prevent="deleteProduct(product.id)" href="#" class="btn btn-danger btn-sm">delete</a>
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
                products:[],
            }
        },
        methods:{
            loadProduct(){
                axios.get('/api/product').then(response =>{
                    this.products = response.data;
                });
            },
            deleteProduct(id){
                
            axios.delete(`/api/product/${id}`).then(()=>{
                 let index = this.products.map(data => data.id).indexOf(id);
                 this.products.splice(index, 1);
                 this.$toaster.success("product deleted successfully");
            });
           

        }
        },
        
        mounted() {
           // console.log('Component mounted.')
           this.loadProduct();
        }
    }
</script>
