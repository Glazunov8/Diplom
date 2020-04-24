<template>
    <div>
        <div v-if="this.error">
            {{this.error}}
        </div>

<!--        <div v-if="this.app.user">-->
<!--            <div v-if="this.app.role === 1">-->
<!--                <el-row>-->
<!--                    <el-col :span="2">ФИО</el-col>-->
<!--                    <el-col :span="6">{{this.app.profile.first_name}}</el-col>-->
<!--                </el-row>-->
<!--            </div>-->


<!--            <div v-if="this.app.role === 2">-->

<!--            </div>-->


<!--            <div v-if="this.app.role === 3">-->
<!--                <el-row>-->
<!--                    <el-col :span="6">Название Организации</el-col>-->
<!--                    <el-col :span="12">{{this.app.profile.name}}</el-col>-->
<!--                </el-row>-->
<!--                <el-row>-->
<!--                    <el-col :span="6">Почта</el-col>-->
<!--                    <el-col :span="12">{{this.app.user.email}}</el-col>-->
<!--                </el-row>-->
<!--                <el-row>-->
<!--                    <el-col :span="6">Сайт</el-col>-->
<!--                    <el-col :span="12">{{this.app.profile.web_site}}</el-col>-->
<!--                </el-row>-->
<!--                <el-row>-->
<!--                    <el-col :span="6">Адрес</el-col>-->
<!--                    <el-col :span="12">{{this.app.profile.address}}</el-col>-->
<!--                </el-row>-->
<!--                <el-row>-->
<!--                    <el-col :span="6">ИНН/КПП</el-col>-->
<!--                    <el-col :span="12">{{this.app.profile.inn_kpp}}</el-col>-->
<!--                </el-row>-->
<!--            </div>-->

<!--            <div v-if="this.app.role === 10">-->
<!--                <h1>Admin</h1>-->
<!--            </div>-->
<!--        </div>-->
        {{this.dadata}}
    </div>
</template>

<script>
    export default {
        name: 'home',
        props: ['app'],
        data() {
            return {
                error: '',
                dadata: null
            };
        },
        mounted() {
            const data = {
                id: '7721581040',
            };
            this.app.req.post('api/get_company', data).then(response =>{
                this.dadata = response.data;
            })
        }
    }
</script>
