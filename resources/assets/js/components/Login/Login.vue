<template>
    <el-form :model="loginForm" ref="loginForm" label-width="100px" class="login-form">
        <el-form-item label="用户名" prop="name">
            <el-input type="text" v-model="loginForm.name"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="password">
            <el-input type="password" v-model="loginForm.password" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="submitForm('loginForm')">登录</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import Cookie from 'js-cookie';
    export default {
        data() {
            let checkName = (rule, value, callback) => {
                if (!value) {
                    return callback(new Error('用户名不能为空'));
                }
            };
            let validatePassword = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('请输入密码'));
                }
            };
            return {
                loginForm: {
                    name: '',
                    password: '',
                },
                rules: {
                    password: [
                        { validator: validatePassword, trigger: 'blur' }
                    ],
                    name: [
                        { validator: checkName, trigger: 'blur' }
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.axios.post('/admin/login', this.loginForm)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.$message.success(response.data.message);
                            this.$router.push('/admin');
                        } else {
                            this.$message.error(response.data.message);
                        }
                    });
            },
        }
    }
</script>

<style>
    .login-form {
        width: 500px;
        margin: 10% auto 0 auto;
        padding: 50px 50px 20px 0px;
        border: 1px solid #e6e6e6;
        border-radius: 5px;
    }
</style>
