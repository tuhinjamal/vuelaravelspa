<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-center"
                    >
                        <h5>Edit Category - {{form.name}}</h5>
                        <a class="btn btn-primary" href="">Category List</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form
                                    @submit.prevent="UpdateCategory"
                                   
                                >
                                    <div class="form-group">
                                        <label for="">Category name</label>
                                        <input
                                            type="text"
                                            v-model="form.name"
                                            class="form-control"
                                            name="name"
                                            placeholder="category name"
                                        />
                                    </div>
                                    <div
                                        v-if="form.errors.has('name')"
                                        v-html="form.errors.get('name')"
                                        style="color: Tomato"
                                    />
                                    <div class="form-group">
                                        <button
                                            type="submit"
                                            :disabled="form.busy"
                                            class="btn btn-success"
                                        >
                                            Update Category
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


import { Form } from "vform";
export default {
    data() {
        return {
            form: new Form({
                name: "",
            }),
            createName: "",
        };
    },
    methods: {
        async UpdateCategory() {
            //console.log('form sumitted');
            // axios.post('/api/category',{name:this.createName}).then(response =>{
            //     console.log(response);
            // });
            let id = this.$route.params.id;

            const response = await this.form
                .put(`/api/category/${id}`)
                .then(() => {
                   // console.log(response);
                    //this.form.name = "";
                    this.$toaster.success("Category updated successfully");
                });
           
        },
        loadCategories(){
                        let id = this.$route.params.id;

                            axios.get(`/api/category/${id}/edit`).then(response =>{
                                // this.categories = response.data;
                            // console.log(response);
                                this.form.name = response.data.name;
                            }).catch (error => {
                console.log(error.response)
                this.isEditMode = false;
            });
            }
        
    },
     mounted() {
           // console.log('Component mounted.')
           this.loadCategories();
        }
};
</script>

<style></style>
