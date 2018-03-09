<template>
    <div>
        <h3>Edit output {{ output.name }}</h3>
        <div class="alert alert-danger" v-if="hasErrors">
            <ul>
                <li v-for="error in errors">{{ error[0] }}</li>
            </ul>
        </div>
        <form @submit.prevent="update">
            <!-- Name form input -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" class="form-control" v-model="output.name"/>
            </div>
            
            <!-- Pin form input -->
            <div class="form-group">
                <label for="pin">Pin (BCM_GPIO nr):</label>
                <input type="text" id="pin" class="form-control" v-model="output.pin"/>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                output: {},
                errors: [],
                hasErrors: false,
            }
        },

        methods: {
            update() {
                axios.patch('api/output/' + this.output.id, {
                    'name': this.output.name,
                    'pin': this.output.pin

                }).then(({data}) => {
                    this.$router.push('/output');
                    flashSuccess(data.message);

                }).catch(({response}) => {
                    this.errors = response.data.errors;
                    this.hasErrors = true;

                    flashError("Could not update your output");
                });
            }
        },

        mounted() {
            let id = this.$route.params.id;

            axios.get('api/output/' + id).then(({data}) => {
                this.output = data.data;
            });
        }
    }
</script>
