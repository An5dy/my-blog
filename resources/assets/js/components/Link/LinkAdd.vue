<template>
    <el-form ref="form" :model="link" label-width="80px">
        <el-form-item label="链接">
            <el-input v-model="link.path" style="width: 400px"></el-input>
        </el-form-item>
        <el-form-item label="简介">
            <el-input v-model="link.description" style="width: 400px"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">确认</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        name: 'LinkAdd',
        data() {
            return {
                link: {
                    path: '',
                    description: '',
                }
            }
        },
        methods: {
            onSubmit() {
                this.axios.post('/admin/links', this.link)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.$message.success('添加成功');
                            this.$router.push('/admin/links');
                        } else {
                            this.$message.error('添加失败');
                        }
                    });
            }
        },
    }
</script>

<style>
</style>
