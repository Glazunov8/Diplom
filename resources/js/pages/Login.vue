<template>
    <div style="width: 600px;
                padding: 10px;
                margin-right: auto;
                margin-left: auto">
        <el-form :model="login" :rules="rules" ref="login" label-width="120px">
            <el-form-item v-if="this.login.error !== ''">
                <div class="alert-danger" style="border-radius: 4px">
                    {{this.login.error}}
                </div>
            </el-form-item>
            <el-form-item label="Логин" prop="email">
                <el-input v-model="login.email"></el-input>
            </el-form-item>
            <el-form-item label="Пароль" prop="password">
                <el-input v-model="login.password" type="password" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item prop="remember">
                <el-checkbox label="Запомнить меня" v-model="login.remember" border></el-checkbox>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('login')">Login</el-button>
            </el-form-item>

            <el-form-item>
                <span>Зарегистрироваться как:</span>
                <el-row>
                    <el-col :span="6">
                        <div>
                            <router-link to="/register_student" tag="el-button">Студент</router-link>
                        </div>

                    </el-col>
                    <el-col :span="6">
                        <router-link to="/register_company" tag="el-button">Организация</router-link>
                    </el-col>
                </el-row>
            </el-form-item>
        </el-form>
    </div>

</template>

<script>
    export default {
        name: 'login',
        props: ['app'],
        data() {
            return {
                login: {
                    email: '',
                    password: '',
                    error: '',
                    remember: false
                },
                rules: {
                    email: [
                        { required: true, message: 'Пожалуйста ввдедите электронную почту',  trigger: 'blur' },
                        { type: 'email', message: 'Электронная почта введена некореектно', trigger: ['blur', 'change'] }
                    ],
                    password: [
                        { required: true, trigger: 'blur' },
                        { min: 6, message: 'Длина пароля должна быть не менее 6', trigger: 'blur' }
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        const data = {
                            email: this.login.email,
                            password: this.login.password,
                            remember: this.remember
                        };
                        this.app.req.post('auth/login', data).then(response =>{
                            this.app.user = response.data;
                            this.app.role = this.app.user.role_id;
                            this.app.get_info();
                            this.$router.push("/home");
                        }).catch(error =>{
                            this.login.error = error.response.data.error;
                        });

                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>
