<template>
    <el-form ref="form" :model="category" label-width="80px">
        <el-form-item label="分类名称">
            <el-input v-model="category.title" style="width: 200px"></el-input>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">确认</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        name: 'CategoryAdd',
        data() {
            return {
                category: {
                    title: '',
                    id: '',
                }
            }
        },
        methods: {
            onSubmit() {
                this.axios.post('/admin/categories', {title: this.category.title})
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.$message.success(response.data.message);
                            this.$router.push('/admin/categories');
                        } else {
                            this.$message.error(response.data.message);
                        }
                    });
            }
        }
    }
</script>

<style>
</style>
