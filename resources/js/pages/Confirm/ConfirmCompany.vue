    <template>
        <div>
            <el-table
                :data="companies.filter(companies => companies.confirmed === false)"
                style="width: 100%">

                <el-table-column type="expand">
                    <template slot-scope="scope">
                        <p>Веб-сайт: {{ scope.row.web_site }}</p>
                        <p>ИНН: {{ scope.row.inn }}</p>
                        <p>КПП: {{ scope.row.kpp }}</p>
                        <p>ОГРН: {{ scope.row.ogrn }}</p>
                        <p>Адрес: {{ scope.row.address }}</p>
                        <p>Номер телефона: {{ scope.row.phone_number }}</p>
                    </template>
                </el-table-column>
                <el-table-column
                    label="Дата создания аккаунта"
                    prop="created_at"
                    width=190>
                </el-table-column>
                <el-table-column
                    label="Предприятие"
                    prop="name">
                </el-table-column>
                <el-table-column
                    label="Тип"
                    prop="type">
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
        name: "ConfirmCompany",
        props: ['app'],
        mounted(){
            axios
                .get('/api/index_company')
                .then(response => {
                    this.loading = true;
                    for(let i = 0; i < response.data.companies.length; i++)
                    {
                        response.data.companies[i].created_at = this.app.getData(response.data.companies[i].created_at.substr(0,10));
                    }

                    this.companies = response.data.companies;

                    for(let i = 0; i < this.companies.length; i++)
                    {
                        if(response.data.companies[i].has_students === true) this.companies[i].type = 'Обр. учреждение';
                        else this.companies[i].type = 'Предприятие';
                    }
                }).catch(error => {
                this.loading = false;


                //this.error = error.response.data.message || error.message;
            });
        },
        data(){
            return{
                companies: [{
                    created_at: '',
                    name: '',
                    phone_number: '',
                    inn: '',
                    kpp: '',
                    ogrn: '',
                    type: '',
                    address: '',
                    web_site: '',
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
                this.app.req.get('api/confirm_company', data).then(response =>{
                    for(let i = 0; i < response.data.companies.length; i++)
                    {
                        response.data.companies[i].created_at = this.app.getData(response.data.companies[i].created_at.substr(0,10));
                    }

                    this.companies = response.data.companies;

                    for(let i = 0; i < this.companies.length; i++)
                    {
                        if(response.data.companies[i].has_students === true) this.companies[i].type = 'Обр. учреждение';
                        else this.companies[i].type = 'Предприятие';
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
                this.app.req.get('api/remove_company', data).then(response =>{
                    for(let i = 0; i < response.data.companies.length; i++)
                    {
                        response.data.companies[i].created_at = this.app.getData(response.data.companies[i].created_at.substr(0,10));
                    }

                    this.companies = response.data.companies;

                    for(let i = 0; i < this.companies.length; i++)
                    {
                        if(response.data.companies[i].has_students === true) this.companies[i].type = 'Обр. учреждение';
                        else this.companies[i].type = 'Предприятие';
                    }
                    // this.$router.push("/");
                }).catch(error =>{
                    this.error = error.response.data.error;
                });
            },
        },
    }
</script>

<style scoped>

</style>
