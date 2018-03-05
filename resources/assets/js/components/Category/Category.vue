<template>
    <div>
        <el-table
                :data="categories"
                height="500"
                border
                style="width: 100%;">
            <el-table-column
                    prop="id"
                    label="ID"
                    width="180"
                    align="center">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="标题"
                    width="180"
                    align="center">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="添加时间"
                    align="center">
            </el-table-column>
            <el-table-column
                    prop="updated_at"
                    label="修改时间"
                    align="center">
            </el-table-column>
            <el-table-column
                    label="操作"
                    width="100"
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
        <div class="pagination">
            <el-pagination
                    layout="prev, pager, next"
                    @current-change="handleCurrentChange"
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    :total="total">
            </el-pagination>
        </div>
        <!-- dialog -->
        <el-dialog
                title="修改分类"
                :visible.sync="dialogFormVisible"
                width="30%"
                :modal="isModel"
                center>
            <el-form :model="currentCategory">
                <el-form-item label="标题" :label-width="formLabelWidth">
                    <el-input v-model="currentCategory.title" auto-complete="off"></el-input>
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
        name: 'Category',
        data() {
            return {
                categories: [],
                total: 0,
                currentPage: 1,
                pageSize: 10,
                dialogFormVisible: false,
                currentCategory: {},
                currentRow: {},
                formLabelWidth: '70px',
                isModel: false,
            }
        },
        methods: {
            getCategories() {
                this.axios.get('/admin/categories?page=' + this.currentPage)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.categories = response.data.data;
                            this.total = response.data.meta.total;
                            this.currentPage = response.data.meta.current_page;
                            this.pageSize = response.data.meta.per_page;
                        } else {
                            this.$message.error(response.data.message);
                        }
                    });
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getCategories();
            },
            handleDelete(index, row) {
                this.axios.post('/admin/categories/' + row.id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.categories.splice(index, 1);
                            this.$message.success('删除成功');
                            this.getCategories();
                        } else {
                            this.$message.error('删除失败');
                        }
                    })
            },
            handleEdit(index, row) {
                this.currentRow = row;
                this.currentCategory = {id: row.id, title: row.title};
                this.dialogFormVisible = true;
            },
            onEdit() {
                this.axios.post('/admin/categories/update/' + this.currentCategory.id, {title: this.currentCategory.title})
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.currentRow.title = this.currentCategory.title;
                            this.$message.success('修改成功');
                            this.dialogFormVisible = false;
                        } else {
                            this.$message.error('修改失败');
                        }
                    })
            }
        },
        mounted() {
            this.getCategories();
        }
    }
</script>

<style scoped lang="css" ref="stylesheet/css">
    .pagination {
        text-align: center;
        margin-top: 20px;
    }
</style>
