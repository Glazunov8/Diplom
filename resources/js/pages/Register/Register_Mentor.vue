<template>
    <div>
        <el-form :model="register" :rules="rules" ref="register" label-width="220px">
            <el-form-item v-if="this.register.error !== ''">
                <div class="alert-danger" style="border-radius: 4px">
                    {{this.register.error}}
                </div>
            </el-form-item>
            <el-form-item label="Фамилия" prop="second_name">
                <el-input v-model="register.second_name"></el-input>
            </el-form-item>
            <el-form-item label="Имя" prop="first_name">
                <el-input v-model="register.first_name"></el-input>
            </el-form-item>
            <el-form-item label="Отчество" prop="patronymic">
                <el-input v-model="register.patronymic"></el-input>
            </el-form-item>
            <el-form-item label="Список технологий" prop="technology_stack">
                <el-input type="textarea" :rows="2" v-model="register.technology_stack"></el-input>
            </el-form-item>
            <el-form-item label="Электронная почта" prop="email">
                <el-input v-model="register.email"></el-input>
            </el-form-item>
            <el-form-item label="Пароль" prop="password">
                <el-input v-model="register.password" type="password" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="Подтвердите пароль" prop="repassword">
                <el-input v-model="register.repassword" type="password" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('register')">Регистрация</el-button>
                <el-button @click="resetForm('register')">Сброс</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
    export default {
        name: 'register_student',
        props: ['app'],
        data() {
            var validatePass = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('Пожалуйста введите пароль'));
                } else {
                    if (this.register.repassword !== '') {
                        this.$refs.register.validateField('repassword');
                    }
                    callback();
                }
            };
            var validatePass2 = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('Пожалуйста введите пароль снова'));
                } else if (value !== this.register.password) {
                    callback(new Error('Пароли не совпадают'));
                } else {
                    callback();
                }
            };

            return {
                register: {
                    first_name: '',
                    second_name: '',
                    patronymic: '',
                    technology_stack: '',
                    email: '',
                    password: '',
                    repassword: '',
                    error: '',
                },
                rules: {
                    first_name: [
                        { required: true, message: 'Пожалуйста введите Имя', trigger: 'blur' },
                        { min: 3, message: 'Длина должна быть не меньше 3', trigger: 'blur' }
                    ],
                    second_name: [
                        { required: true, message: 'Пожалуйста введите Фамилию', trigger: 'blur' },
                        { min: 3, message: 'Длина должна быть не меньше 3', trigger: 'blur' }
                    ],
                    patronymic: [
                        { required: true, message: 'Пожалуйста введите Отчество', trigger: 'blur' },
                        { min: 3, message: 'Длина должна быть не меньше 3', trigger: 'blur' }
                    ],
                    technology_stack: [
                        { required: true, message: 'Пожалуйста введите Группу', trigger: 'blur' },
                        { min: 3, message: 'Длина должна быть не меньше 3', trigger: 'blur' },
                        { max:255, message: 'Длина должна быть не больше 255', trigger: 'blur' }
                    ],
                    email: [
                        { required: true, message: 'Пожалуйста введите Электронную почту',  trigger: 'blur' },
                        { type: 'email', message: 'Электронная почта введена некорректно', trigger: ['blur', 'change'] }
                    ],
                    password: [
                        { required: true, validator: validatePass,  trigger: 'blur' },
                        { min: 6, message: 'Длина пароля должна быть не меньше 6', trigger: 'blur' }
                    ],
                    repassword: [
                        { required: true, validator: validatePass2,  trigger: 'blur'  },
                        { min: 6, message: 'Длина пароля должна быть не меньше 6', trigger: 'blur' }
                    ]
                }
            };
        },

        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        const data = {
                            first_name: this.register.first_name,
                            second_name: this.register.second_name,
                            patronymic: this.register.patronymic,
                            company_id: this.app.profile.id,
                            technology_stack: this.register.technology_stack,
                            email: this.register.email,
                            password: this.register.password
                        };

                        this.app.req.post('auth/register_mentor', data).then(response =>{
                            this.$router.push("/home");
                        }).catch(error =>{
                            this.register.error = error.response.data.error;
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

<style>
    .companies{
        max-width: 500px;
        overflow: hidden;
    }
</style>
