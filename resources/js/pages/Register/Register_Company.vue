<template>
    <el-form :model="register" :rules="rules" ref="register" label-width="220px">
        <el-form-item v-if="this.register.error !== ''">
            <div class="alert-danger" style="border-radius: 4px">
                {{this.register.error}}
            </div>
        </el-form-item>
        <el-form-item label="ИНН" prop="inn">
            <el-input v-model="register.inn" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" ></el-input>
            <span>Введите ИНН для автозаполнения</span>
        </el-form-item>
        <el-form-item label="ОГРН" prop="ogrn">
            <el-input v-model="register.ogrn" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="13" ></el-input>
            <span>Введите ОГРН для автозаполнения</span>
        </el-form-item>
        <el-form-item label="КПП" prop="kpp">
            <el-input v-model="register.kpp" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="9" ></el-input>
        </el-form-item>
        <el-form-item label="Название" prop="name">
            <el-input v-model="register.name"></el-input>
        </el-form-item>
<!--        <el-form-item label="Тип организации" prop="has_students">-->
<!--            <el-radio-group v-model="register.has_students">-->
<!--                <el-radio label="true" border>Образовательное учреждение</el-radio>-->
<!--                <el-radio label="false" border>Предприятие</el-radio>-->
<!--            </el-radio-group>-->
<!--            {{this.register.ogrn}}-->
<!--        </el-form-item>-->

        <el-form-item label="Сайт" prop="web_site">
            <el-input v-model="register.web_site"></el-input>
        </el-form-item>
        <el-form-item label="Телефонный номер" prop="phone_number">
            <el-input id="phone" v-model="register.phone_number"></el-input>
        </el-form-item>
        <el-form-item label="Юридический адрес" prop="address">
            <el-input v-model="register.address"></el-input>
        </el-form-item>
        <el-form-item label="E-mail" prop="email">
            <el-input v-model="register.email"></el-input>
        </el-form-item>
        <el-form-item label="Пароль" prop="password">
            <el-input v-model="register.password" type="password" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item label="Подтвердите пароль" prop="repassword">
            <el-input v-model="register.repassword" type="password" autocomplete="off"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('register')">Регистрациия</el-button>
            <el-button @click="resetForm('register')">Сброс</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import Inputmask from 'inputmask';

    export default {
        name: 'register_company',
        props: ['app'],
        mounted() {
            var im = new Inputmask("8-999-999-99-99");
            im.mask(document.getElementById('phone'));
        },
        data() {

            var validateInn = (rule, value, callback) => {
                if(value === '')
                    callback(new Error('Пожалуйста введите ИНН'));
                else{
                    // if(!value.isLength(10))
                    //     callback(new Error('ИНН введен некорректно'));
                    // else{
                        getCompany(this.register.inn);
                    // }
                }
            };

            var validateOgrn = (rule, value, callback) => {
                if(value === '')
                    callback(new Error('Пожалуйста введите ОГРН'));
                else{
                    // if(!value.isLength(10))
                    //     callback(new Error('ОГРН введен некорректно'));
                    // else{
                        getCompany(this.register.ogrn);
                    // }
                }
            };

            var getCompany = (id) =>{
                const data = {
                    id: id.toString(),
                };
                this.app.req.post('api/get_company', data).then(response=>{
                    if(response != null){
                        this.company = response.data;
                        this.register.inn = response.data.data.inn;
                        this.register.ogrn = response.data.data.ogrn;
                        this.register.address = response.data.data.address.value;
                        this.register.kpp = response.data.data.kpp;
                        this.register.name = response.data.unrestricted_value;

                        let str = response.data.data.okved;
                        let firstNum = str.substr(0, 2);
                        let secondNum = str.substr(3, 1)

                        if(Number(firstNum) === 85 && (Number(secondNum) === 2 || Number(secondNum === 3)))
                        {
                            this.register.has_students = true;
                        }
                    }
                })
            }

            var validatePhone = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('Пожалуйста введите номер телефона'));
                } else {
                    if (this.register.phone_number !== '') {
                        var test = this.register.phone_number;
                        for(let i = 0; i < test.length; i++){
                            test = test.replace('_','');
                        }
                        if(test.length < 15)
                        {
                            callback(new Error('Пожалуйста введите номер телефона правильно'));
                        }
                    }
                    callback();
                }
            };

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
                company: null,
                register: {
                    name: '',
                    has_students: false,
                    address: '',
                    web_site:'',
                    inn:'',
                    ogrn:'',
                    kpp:'',
                    phone_number:'',
                    email: '',
                    password: '',
                    repassword: '',
                    error: ''
                },
                rules: {
                    name: [
                        { required: true, message: 'Пожалуйста введите навзвание копмании', trigger: 'blur' },
                        { min: 3, message: 'Длина должна быть не меньше 3', trigger: 'blur' }
                    ],
                    // has_students: [
                    //     {required: true, message: 'Пожалуйста выберите тип организации', trigger: 'blur'}
                    // ],
                    inn: [
                        { min: 10, message: 'ИНН введен некорректно', trigger: 'blur' },
                        { required: true, validator:  validateInn, trigger: 'blur' }

                    ],
                    kpp: [
                        { required: true, message: 'Пожалуйста введите КПП копмании', trigger: 'blur' },
                        { min: 9, message: 'КПП введен некорректно', trigger: 'blur' }
                    ],
                    ogrn: [
                        { min: 13, message: 'ОГРН введен некорректно', trigger: 'blur' },
                        { required: true, message: 'Пожалуйста введите ОГРН копмании', validator:  validateOgrn, trigger: 'blur' }

                    ],
                    address: [
                        { required: true, message: 'Пожалуйста введите адрес копмании', trigger: 'blur' }
                    ],
                    web_site: [
                        { required: true, message: 'Пожалуйста введите сайт копмании', trigger: 'blur' },
                        { type: 'url', message: 'Сайт компании введен некорректно', trigger: ['blur', 'change'] }
                    ],
                    inn_kpp: [
                        { required: true, message: 'Пожалуйста введите ИНН/КПП копмании', trigger: 'blur' },
                        { min: 9, max: 10, message: 'ИНН/КПП введен некорректно', trigger: 'blur'}
                    ],
                    phone_number: [
                        { required: true, validator: validatePhone, trigger: 'blur' }
                    ],
                    email: [
                        { required: true, message: 'Пожалуйста введите электронную почту копмании',  trigger: 'blur' },
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
                // this.$refs[formName].validate((valid) => {
                //     if (valid) {
                        const data = {
                            name: this.register.name,
                            has_students: this.register.has_students,
                            address: this.register.address,
                            web_site: this.register.web_site,
                            phone_number: this.register.phone_number,
                            inn: this.register.inn,
                            kpp: this.register.kpp,
                            ogrn: this.register.ogrn,
                            email: this.register.email,
                            password: this.register.password
                        };

                        this.app.req.post('auth/register_company', data).then(response =>{
                            this.$router.push("/login");
                        }).catch(error =>{
                            this.register.error = error.response.data.error;
                        });

                //     } else {
                //         console.log('error submit!!');
                //         return false;
                //     }
                // });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>
