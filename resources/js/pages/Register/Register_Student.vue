<template>
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
        <el-form-item label="Образовательное учреждение" prop="group">
            <el-select v-model="register.institute_id" filterable placeholder="Select">
                <el-option
                    v-for="item in institutes"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id">
                </el-option>
            </el-select>
        </el-form-item>
        <el-form-item label="Группа" prop="group">
            <el-input v-model="register.group"></el-input>
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
                institutes: null,

                register: {
                    first_name: '',
                    second_name: '',
                    patronymic: '',
                    group: '',
                    institute_id: '',
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
                    group: [
                        { required: true, message: 'Пожалуйста введите Группу', trigger: 'blur' },
                        { min: 3, message: 'Длина должна быть не меньше 3', trigger: 'blur' }
                    ],
                    institute_id: [
                        {required: true, messege:'Пожалуйста выберете Образовательное учреждение', trigger:'blur'}
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

        mounted() {
            axios
                .post('/api/index_company')
                .then(response => {
                    this.loading = false;
                    this.institutes = response.data.institutes;
                }).catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });
        },

        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        const data = {
                            first_name: this.register.first_name,
                            second_name: this.register.second_name,
                            patronymic: this.register.patronymic,
                            institute_id: this.register.institute_id,
                            group: this.register.group,
                            email: this.register.email,
                            password: this.register.password
                        };

                        this.app.req.post('auth/register_student', data).then(response =>{
                            this.$router.push("/login");
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
