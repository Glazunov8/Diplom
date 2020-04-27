<template>
    <div>
        <el-table
            :data="students.filter(students => students.confirmed === false)"
            style="width: 100%">
            <el-table-column
                label="Дата создания аккаунта"
                prop="created_at"
                width=190>
            </el-table-column>
            <el-table-column
                label="ФИО"
                prop="name"
                width=320>
            </el-table-column>
            <el-table-column
                label="Группа"
                prop="group">
            </el-table-column>
            <el-table-column
                label=""
                width=300>
                <template slot-scope="scope">
                    <el-button type="primary" @click="confirm(scope.row.id)" size="small">Подтвердить</el-button>
                    <el-button type="danger" @click="reject(scope.row.id)" size="small">Отклонить</el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>

</template>

<script>
    export default {
        name: "ConfirmStudent",
        props: ['app'],
        mounted(){
            axios
                .get('/api/index_student')
                .then(response => {
                    this.loading = true;
                    for(let i = 0; i < response.data.length; i++)
                    {
                        response.data[i].created_at = this.app.getData(response.data[i].created_at.substr(0,10));
                    }

                    this.students = response.data;

                    for(let i = 0; i < response.data.length; i++)
                    {
                        this.students[i].name = response.data[i].second_name + " " + response.data[i].first_name + " " + response.data[i].patronymic;
                    }
                }).catch(error => {
                this.loading = false;


                //this.error = error.response.data.message || error.message;
            });
        },
        data(){
            return{
                students: [{
                    name: '',
                    group: '',
                    created_at: ''
                }],
                error: '',
            }
        },
        methods:{
            confirm(index)
            {
                const data = {
                    id: index
                };
                this.app.req.get('api/confirm_student', data).then(response =>{
                    for(let i = 0; i < response.data.length; i++)
                    {
                        response.data[i].created_at = this.app.getData(response.data[i].created_at.substr(0,10));
                    }

                    this.students = response.data;

                    for(let i = 0; i < response.data.length; i++)
                    {
                        this.students[i].name = response.data[i].second_name + " " + response.data[i].first_name + " " + response.data[i].patronymic;
                    }
                    // this.$router.push("/");
                }).catch(error =>{
                    this.error = error.response.data.error;
                });
            },
            reject(index)
            {
                const data = {
                    id: index
                };
                this.app.req.get('api/remove_student', data).then(response =>{
                    for(let i = 0; i < response.data.length; i++)
                    {
                        response.data[i].created_at = this.app.getData(response.data[i].created_at.substr(0,10));
                    }

                    this.students = response.data;

                    for(let i = 0; i < response.data.length; i++)
                    {
                        this.students[i].name = response.data[i].second_name + " " + response.data[i].first_name + " " + response.data[i].patronymic;
                    }
                }).catch(error =>{
                    this.error = error.response.data.error;
                });
            },
        },
    }
</script>

<style scoped>

</style>
