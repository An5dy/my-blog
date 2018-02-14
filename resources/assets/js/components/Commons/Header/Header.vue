<template>
    <el-header>
        <el-row>
            <el-col :span="6" class="logo">
                <router-link to="/admin/article/add">后台管理</router-link>
            </el-col>
            <el-col :span="6" :offset="12">
                <el-dropdown @command="handleCommand">
                        <span class="el-dropdown-link">
                            管理员<i class="el-icon-arrow-down el-icon--right"></i>
                        </span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item command="passwordReset">
                            修改密码
                        </el-dropdown-item>
                        <el-dropdown-item divided command="logout">退出</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-col>
            <!-- dialog -->
            <el-dialog
                    title="修改密码"
                    :visible.sync="dialogFormVisible"
                    width="30%"
                    center>
                <el-form :model="user">
                    <el-form-item label="原密码" :label-width="formLabelWidth">
                        <el-input v-model="user.oldPassword" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="新密码" :label-width="formLabelWidth">
                        <el-input v-model="user.newPassword" auto-complete="off"></el-input>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click="dialogFormVisible = false">取 消</el-button>
                    <el-button type="primary" @click="onSubmit">确 定</el-button>
                </div>
            </el-dialog>
        </el-row>
    </el-header>
</template>

<script>
    export default {
        name: 'Header',
        data () {
            return {
                user: {
                    oldPassword: '',
                    newPassword: '',
                },
                dialogFormVisible: false,
                formLabelWidth: '70px',
            }
        },
        methods: {
            handleCommand(command) {
                if (command === 'logout') {
                    this.axios.post('/admin/logout')
                        .then(response => {
                            if (response.data.code === '10000') {
                                this.$message.success(response.data.message);
                                this.$router.push('/admin/login');
                            }
                        });
                }
                if (command === 'passwordReset') {
                    this.dialogFormVisible = true;
                }
            },
            onSubmit() {
                this.axios.post('/admin/reset_password', this.user)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.$message.success(response.data.message);
                            this.dialogFormVisible = false;
                        } else {
                            this.$message.error(response.data.message);
                        }
                    })
            }
        }
    }
</script>

<style scoped lang="css" ref="stylesheet/css">
    .el-header {
        position:absolute;
        left:0;
        top:0;
        right:0;
        height: 60px;
        background-color: white;
        border-bottom: 1px solid #e6e6e6;
        text-align: right;
        line-height: 60px;
    }
    .logo {
        text-align: left;
        font-size: 20px;
    }
</style>
