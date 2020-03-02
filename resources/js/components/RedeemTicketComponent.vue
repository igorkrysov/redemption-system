<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Redemeption page</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <div class="form-group">
                                        <label for="uuid">UUID of ticket</label>
                                        <input type="text" v-model="uuid" class="form-control" id="uuid" required aria-describedby="uuid" placeholder="Enter uuid">                                
                                    </div>
                                    <button @click.prevent="remeed" class="btn btn-primary">Remmed</button>
                                </form>
                            </div>
                            
                        </div>
                        <div class="row" v-show="response !== ''">
                            <div class="col-12">
                                <vue-pretty-json :path="'res'" :data="response"></vue-pretty-json>
                            </div>
                        </div>
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
                uuid: '',
                response: ''             
            }
        },
        props: ['redirectUrl'],
        methods: {
            remeed() {
                let formData = new FormData()
                formData.append('uuid', this.uuid)
                axios.post('/api/ticket/redeem', formData)
                    .then(response =>  {
                        this.response = response.data
                        if (response.data.status) {
                        }                        
                    })
                    .catch(error => {
                        this.response = error;
                        if (error.response.status === 401) {
                            this.response = error.response;
                            console.log(error.response)
                        }
                        console.log(error)
                    })
                    
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
