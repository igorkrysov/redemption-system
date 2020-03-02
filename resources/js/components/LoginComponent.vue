<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login page</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" autocomplete="off" v-model="email" class="form-control" id="email" required aria-describedby="emailHelp" placeholder="Enter email">                                
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Password</label>
                                        <input type="password" autocomplete="off" v-model="password" class="form-control" id="pass" required placeholder="Password">
                                    </div>
                                    <button type="submit" @click.prevent="login" class="btn btn-primary">Login</button>
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
                email: 'test@mail.com',
                password: 'secret',
                response: ''
            }
        },
        props: ['redirectUrl'],
        methods: {
            login() {
                let formData = new FormData()
                formData.append('email', this.email)
                formData.append('password', this.password)
                axios.post('/api/login', formData)
                    .then(response =>  {
                        this.response = response.data
                        if (response.data.status) {
                            localStorage.setItem('user-token', response.data.token);
                            window.location.href = this.redirectUrl;
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
