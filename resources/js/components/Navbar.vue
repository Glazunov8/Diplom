<template>
    <div>
        <el-menu :default-active="activeIndex" mode="horizontal"
                 @select="handleSelect"
                 background-color="#545c64"
                 text-color="#fff"
                 active-text-color="#ffd04b">
            <el-menu-item index="1" >
                <router-link to="/home" tag="div">Home</router-link>
            </el-menu-item>

            <el-menu-item index="2" v-if="!this.app.user">
                <router-link to="/login" tag="div">Login</router-link>
            </el-menu-item>

            <el-submenu index="2" v-else>
                    <template slot="title">
                        {{app.user.name}}
                    </template>
                    <el-menu-item index="2-1">
                        <el-link style="color: #fff" :underline="false" @click="logout">Logout</el-link>
                    </el-menu-item>
            </el-submenu>
            <el-menu-item index="3" v-if="this.app.role === 10">
                <router-link to="/confirm_company" tag="div">Подтвердить Предприятия</router-link>
            </el-menu-item>
        </el-menu>
    </div>

</template>

<script>

    export default {
        name: 'navbar',
        props: ['app'],
        data() {
            return {
                error: '',
                activeIndex: '1',
                activeIndex2: '1'
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            logout()
            {
                this.app.req.post('auth/logout').then(() =>{
                    this.app.user = null;
                    this.app.profile = null;
                    this.$router.push('/login');
                });
            }
        }
    }
</script>

<style>
</style>
