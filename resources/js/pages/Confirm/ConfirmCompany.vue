    <template>
        <el-table
            :data="companies.filter(companies => companies.confirmed === false)"
            style="width: 100%">
            <el-table-column type="expand">
                <template slot-scope="scope">
                    <p>Веб-сайт: {{ scope.row.web_site }}</p>
                    <p>ИНН/КПП: {{ scope.row.inn_kpp }}</p>
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
                label=""
                width=300>
                <template slot-scope="scope">
                        <el-button type="success" @click="confirm(scope.row.id)" size="small">Подтвердить</el-button>
                </template>
            </el-table-column>
        </el-table>
    </template>

<script>
    export default {
        name: "ConfirmCompany",
        props: ['app'],
        mounted(){
            axios
                .post('/api/index_company')
                .then(response => {
                    this.loading = false;
                    this.companies = response.data.companies;
                }).catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });
        },
        data(){
            return{
                companies: [{
                    created_at: '',
                    name: '',
                    phone_number: '',
                    inn_kpp: '',
                    address: '',
                    web_site: '',
                }],
                error: ''
            }
        },
        methods:{
            confirm(index)
            {
                const data = {
                    id: index
                };
                this.app.req.post('api/confirm_company', data).then(response =>{
                    this.companies = response.data.companies;
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
