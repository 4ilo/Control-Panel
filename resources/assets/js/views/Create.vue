<template>
    <div>
        <h3>Create new output</h3>
        <div class="alert alert-danger" v-if="hasErrors">
            <ul>
                <li v-for="error in errors">{{ error[0] }}</li>
            </ul>
        </div>
        <form @submit.prevent="create">
            <!-- Name form input -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" class="form-control" v-model="name"/>
            </div>
            
            <!-- Pin form input -->
            <div class="form-group">
                <label for="pin">Pin (BCM_GPIO nr):</label>
                <input type="text" id="pin" class="form-control" v-model="pin"/>
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                name: '',
                pin: '',
                errors: [],
                hasErrors: false,
            }
        },

        methods: {
            create() {
                axios.post('api/output', {
                    'name': this.name,
                    'pin': this.pin

                }).then(({data}) => {
                    this.$router.push('/output');
                    flashSuccess(data.message);

                }).catch(({response}) => {
                    this.errors = response.data.errors;
                    this.hasErrors = true;

                    flashError("Could not save your output");
                });
            }
        }
    }
</script>
