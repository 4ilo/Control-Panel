<template>
    <div>
        <h3>Control the outputs</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Pin</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
            </thead>
            
            <tbody>
            <tr v-for="output in outputs">
                <td>{{ output.name }}</td>
                <td>{{ output.pin }}</td>
                <td>
                    <router-link :to="{name: 'edit', params: {id: output.id}}">
                        <i class="fa fa-edit"></i>
                    </router-link>
                </td>
                <td>
                    <a style="color: red;" href="#" @click="del(output.id)">
                        <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        
        </table>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                outputs: []
            }
        },

        methods: {
            del(id) {
                axios.delete('/api/output/' + id).then(({data}) => {
                    for (let i = 0; i < this.outputs.length; i++) {
                        if (this.outputs[i].id === id) {
                            this.outputs.splice(i, 1);
                        }
                    }

                    flashSuccess(data.message);
                });
            }
        },

        mounted() {
            axios.get('/api/output').then(({data}) => {
                this.outputs = data.data
            });
        }
    }
</script>
