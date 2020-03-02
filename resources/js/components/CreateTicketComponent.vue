<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create ticket</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <div class="form-group">
                                        <label for="fname">First name</label>
                                        <input type="text" v-model="fname" class="form-control" id="fname" required placeholder="First name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lname">Last name</label>
                                        <input type="text" v-model="lname" class="form-control" id="lname" required placeholder="Last name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" v-model="email" class="form-control" id="exampleInputEmail1" required aria-describedby="emailHelp" placeholder="Enter email">                                
                                    </div>
                                    <button @click.prevent="create" class="btn btn-primary">Create</button>
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
                email: '',
                fname: '',
                lname: '',
                response: ''
            }
        },
        props: ['redirectUrl'],
        methods: {
            create() {
                let formData = new FormData()
                formData.append('email', this.email)
                formData.append('fname', this.fname)
                formData.append('lname', this.lname)
                axios.post('/api/ticket/create', formData)
                    .then(response =>  {
                        this.response = response
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
