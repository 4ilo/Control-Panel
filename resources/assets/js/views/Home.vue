<template>
    <div class="container">
        <div class="row mt-5" v-for="(set, setNr) in outputs">
            <div class="col-sm-4" v-for="(output, outputNr) in set">
                <div class="card" style="width: 18rem;">
                    <div class="card-header text-center">{{ output.name }}</div>
                    <div style="font-size: 40px;" class="text-center">
                        <i class="fa fa-bolt" v-if="output.active" style="color: green"></i>
                        <i class="fa fa-bolt" v-else style="color: red"></i>
                    </div>
                    
                    <div class="card-body">
                        <button class="btn btn-success float-left" @click="enable(output.id, setNr, outputNr)">
                            Enable
                        </button>
                        <button class="btn btn-danger float-right" @click="disable(output.id, setNr, outputNr)">
                            Disable
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                outputs: [],
            }
        },

        methods: {
            chunk(arr, chunkSize) {
                let groups = [];

                for (let i = 0; i < arr.length; i += chunkSize) {
                    groups.push(arr.slice(i, i + chunkSize))
                }

                return groups;
            },

            enable(id, set, index) {
                axios.get('api/output/' + id + '/enable').then(({data}) => {
                    flashSuccess(data.message);
                    this.outputs[set][index].active = true;

                }).catch(() => {
                    flashError('Unable to enable output');
                });
            },

            disable(id, set, index) {
                axios.get('api/output/' + id + '/disable').then(({data}) => {
                    flashSuccess(data.message);
                    this.outputs[set][index].active = false;

                }).catch(() => {
                    flashError('Unable to disable output');
                });
            }
        },

        mounted() {
            axios.get('api/output').then(({data}) => {
                this.outputs = this.chunk(data.data, 3);
            });
        }
    }
</script>
