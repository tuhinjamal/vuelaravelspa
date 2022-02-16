<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-center"
                    >
                        <h5>Create product</h5>
                        <a class="btn btn-primary" href="">Product List</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form
                                    @submit.prevent="createProduct"
                                    @keydown="form.onKeydown($event)"
                                >
                                    <div class="form-group">
                                        <label for="">product title</label>
                                        <input
                                            type="text"
                                            v-model="form.title"
                                            class="form-control {'is-invalid':form.errors.has('title')}"
                                            title="title"
                                            placeholder="product title"
                                        />
                                    </div>
                                    <div
                                        v-if="form.errors.has('title')"
                                        v-html="form.errors.get('title')"
                                        style="color: Tomato"
                                    />
                                    <div class="form-group">
                                        <label for="">product price</label>
                                        <input
                                            type="number"
                                            v-model="form.price"
                                            class="form-control {'is-invalid':form.errors.has('price')}"
                                            title="price"
                                            placeholder="product price"
                                        />
                                    </div>

                                    <div
                                        v-if="form.errors.has('price')"
                                        v-html="form.errors.get('price')"
                                        style="color: Tomato"
                                    />

                                      <div class="form-group">
                                        <label for="">product description</label>
                                       
                                        <textarea  class="form-control {'is-invalid':form.errors.has('description')}"
                                           type="text"
                                            title="description"
                                              name="description"  cols="30" rows="3" ></textarea>
                                    </div>

                                   
                                      <div class="form-group">
                                        <label for="">product image</label><br>
                                        <input
                                            type="file"
                                            class="form-control-file {'is-invalid':form.errors.has('image')}"
                                            title="image"
                                            placeholder="product image"
                                            @change="onImageChange" 
                                        />
                                    </div>

                                    <div
                                        v-if="form.errors.has('image')"
                                        v-html="form.errors.get('image')"
                                        style="color: Tomato"
                                    />
                                    <div class="form-group">
                                        <button
                                            type="submit"
                                            :disabled="form.busy"
                                            class="btn btn-success"
                                        >
                                            Create product
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import axios from "axios"
import "cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css";

import { Form } from "vform";
import {objectToFormData} from 'object-to-formdata';
export default {
    data() {
        return {
            form: new Form({
                title: "",
                price: "",
                description: "",
                image:"",
            }),
           
        };
    },
    methods: {
        async createProduct() {
            //console.log('form sumitted');
            // axios.post('/api/category',{name:this.createName}).then(response =>{
            //     console.log(response);
            // });

            const response = await this.form
                .post("/api/product", {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                })
                .then((response) => {
                    console.log(response);
                    this.form.title = "";
                    this.form.price = "";
                    this.form.description="";
                    this.form.image="";
                    this.$toaster.success("Product added successfully");
                });
        },
        onImageChange(e){
            const file = e.target.files[0]
            // Do some client side validation...
            this.form.image = file
        },
    },
};
</script>

<style></style>
