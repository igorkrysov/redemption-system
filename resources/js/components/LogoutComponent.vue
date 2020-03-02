<template>
    <div>
        <button v-if="token" class="btn" type="button" @click.prevent="logout">Logout</button>
        <button v-else class="btn" type="button" @click.prevent="login">Login</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: ''
            }
        },
        methods: {
            login() {
                window.location.href = '/login';
            },
            logout() {
                localStorage.setItem('user-token', null);
                this.token = null;
                axios.defaults.headers.common['Authorization'] = null;
                // let formData = new FormData()
                // axios.post('/api/logout', formData)
                //     .then(response =>  {
                //         this.response = response.data
                //         if (response.data.status) {
                //             localStorage.setItem('user-token', null);
                //             window.location.href = '/login';
                //         }                        
                //     })
                //     .catch(error => {
                //         this.response = error;
                //         if (error.response.status === 401) {
                //             this.response = error.response;
                //             localStorage.setItem('user-token', null);
                //             console.log(error.response)
                //         }
                //         console.log(error)
                //     })
                    
            }
        },
        mounted() {
            this.token = localStorage.getItem('user-token')
        }
    }
</script>
