<template>
    <el-container>
        <el-header style="margin:0; padding:0">
            <navbar :app="this"></navbar>
        </el-header>
        <el-main style="padding:0;">
            <div style="width: 60pc ; margin-left: auto; margin-right: auto; min-height:1200px; background: #fefefe; padding: 10px">
                <router-view :app="this"></router-view>
            </div>
        </el-main>
        <div style="height:100px; background: #aaa; padding: 10px">
        </div>
    </el-container>
</template>

<script>
    import Navbar from './components/Navbar';
    export default {
        name: 'app',
        components:{
            Navbar
        },
        data() {
            return{
                user: null,
                loading: false,
                initiated: false,
                profile: null,
                role: '',
                req: axios.create({
                    baseUrl: BASE_URL
                })
            };
        },
        mounted() {
            this.init();
        },
        methods:{
            init()
            {
                this.loading = true;

                this.req.get('auth/init').then(response => {
                    if(response.data.user)
                    {
                        this.user = response.data.user;
                        this.role = this.user.role_id;
                        this.loading = false;
                        this.initiated = true;

                        this.get_info();

                    }
                })
            },

            get_info ()
            {
                this.req.get('api/get_info').then(response =>{
                    this.profile = response.data;
                });
            }
        }
    };
</script>

