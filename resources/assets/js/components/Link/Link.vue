<template>
    <div>
        <el-table
                :data="links"
                height="500"
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="ID"
                    align="center"
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="path"
                    label="链接"
                    align="center">
            </el-table-column>
            <el-table-column
                    prop="description"
                    align="center"
                    label="简介">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    align="center"
                    width="180"
                    label="创建时间">
            </el-table-column>
            <el-table-column
                    prop="updated_at"
                    align="center"
                    width="180"
                    label="修改时间">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="100"
                    fixed="right"
                    align="center">
                <template slot-scope="scope">
                    <el-button
                            size="small"
                            type="text"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                    <el-button
                            size="small"
                            type="text"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                </template>
            </el-table-column>
        </el-table>
        <!-- dialog -->
        <el-dialog
                title="修改链接"
                :visible.sync="dialogFormVisible"
                width="40%"
                :modal="isModel"
                center>
            <el-form :model="currentLink">
                <el-form-item label="链接" :label-width="formLabelWidth">
                    <el-input v-model="currentLink.path" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="简介" :label-width="formLabelWidth">
                    <el-input v-model="currentLink.description" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="onEdit">确 定</el-button>
            </div>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        name: 'Link',
        data() {
            return {
                links: [],
                isModel: false,
                dialogFormVisible: false,
                formLabelWidth: '70px',
                currentLink: {},
            }
        },
        methods: {
            handleDelete(index, row) {
                this.axios.post('/admin/links/' + row.id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.links.splice(index, 1);
                            this.$message.success('删除成功');
                        } else {
                            this.$message.error('删除失败');
                        }
                    });
            },
            handleEdit(index, row) {
                this.currentRow = row;
                this.currentLink = {id: row.id, path: row.path, description: row.description};
                this.dialogFormVisible = true;
            },
            getLinks() {
                this.axios.get('/admin/links')
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.links = response.data.data;
                        }
                    });
            },
            onEdit() {
                let formData = {path: this.currentLink.path, description: this.currentLink.description};
                this.axios.post('/admin/links/update/' + this.currentLink.id, formData)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.currentRow.path = this.currentLink.path;
                            this.currentRow.description = this.currentLink.description;
                            this.$message.success('修改成功');
                            this.dialogFormVisible = false;
                        } else {
                            this.$message.error('修改失败');
                        }
                    });
            }
        },
        mounted() {
            this.getLinks();
        },
    }
</script>

<style>
</style>
