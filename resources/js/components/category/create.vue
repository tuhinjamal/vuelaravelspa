<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header d-flex justify-content-between align-items-center"
                    >
                        <h5>Create Category</h5>
                        <router-link class="nav-link active" aria-current="page" :to="{name:'category-list'}">Category</router-link>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 offset-3">
                                <form
                                    @submit.prevent="createCategory"
                                    @keydown="form.onKeydown($event)"
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
                                            Create Category
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
        async createCategory() {
            //console.log('form sumitted');
            // axios.post('/api/category',{name:this.createName}).then(response =>{
            //     console.log(response);
            // });

            const response = await this.form
                .post("/api/category")
                .then((response) => {
                    console.log(response);
                    this.form.name = "";
                    this.$toaster.success("Category added successfully");
                });
        },
    },
};
</script>

<style></style>
