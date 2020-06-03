<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Upload CSV file to update data. <b>This may take a few minutes.</b>
            </div>

            <div class="card-body">
                <div v-if="success != ''" class="alert alert-success" role="alert">
                    {{success}}
                </div>
                <form @submit="formSubmit" enctype="multipart/form-data">
                    <strong>File:</strong>
                    <input type="file" class="form-control" v-on:change="onFileChange">

                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                file: '',
                success: ''
            };
        },
        methods: {
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('csv', this.file);

                axios.post('/upload', formData, config)
                    .then(function (response) {
                        currentObj.success = response.data.success;
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
            }
        }
    }
</script>
