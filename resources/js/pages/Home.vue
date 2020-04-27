<template>
    <div>
        <div v-if="this.error">
            {{this.error}}
        </div>

        <div v-if="this.app.profile">
            <div v-if="this.app.role === 1">
                <el-row>
                    <el-col :span="6">Отчество</el-col>
                    <el-col :span="12">{{this.app.profile.second_name}}</el-col>
                </el-row>
            </div>

            <div v-if="this.app.role === 2">

            </div>

            <div v-if="this.app.role === 3">
                <el-row>
                    <el-col :span="6">Название:</el-col>
                    <el-col :span="12">{{this.app.profile.name}}</el-col>
                </el-row>
                <el-row>
                    <el-col :span="6">ИНН:</el-col>
                    <el-col :span="12">{{this.app.profile.inn}}</el-col>
                </el-row>
                <el-row>
                    <el-col :span="6">КПП:</el-col>
                    <el-col :span="12">{{this.app.profile.kpp}}</el-col>
                </el-row>
                <el-row>
                    <el-col :span="6">ОГРН:</el-col>
                    <el-col :span="12">{{this.app.profile.ogrn}}</el-col>
                </el-row>
                <el-row>
                    <el-col :span="6">Адрес:</el-col>
                    <el-col :span="12">{{this.app.profile.address}}</el-col>
                </el-row>
                <el-row>
                    <el-col :span="6">Веб-сайт:</el-col>
                    <el-col :span="12">{{this.app.profile.web_site}}</el-col>
                </el-row>
            </div>
        </div>
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
    }
</script>
