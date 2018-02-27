<template>
    <div>
        <el-table
                :data="thoughts"
                height="500"
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="ID"
                    align="center"
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="title"
                    align="center"
                    label="标题">
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
        <div class="pagination">
            <el-pagination
                    layout="prev, pager, next"
                    @current-change="handleCurrentChange"
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    :total="total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Thought',
        data() {
            return {
                thoughts: [],
                total: 0,
                currentPage: 1,
                pageSize: 10,
            }
        },
        methods: {
            getThoughts() {
                this.axios.get('/admin/thoughts?page=' + this.currentPage)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.thoughts = response.data.data;
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
                this.getThoughts();
            },
            handleDelete(index, row) {
                this.axios.post('/admin/thoughts/' + row.id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.thoughts.splice(index, 1);
                            this.$message.success('删除成功');
                            this.getArticles();
                        } else {
                            this.$message.error('删除失败');
                        }
                    })
            },
            handleEdit(index, row) {
                this.$router.push('/admin/thoughts/edit/' + row.id);
            },
        },
        mounted() {
            this.getThoughts();
        }
    }
</script>

<style scoped lang="css" ref="stylesheet/css">
    .pagination {
        text-align: center;
        margin-top: 20px;
    }
</style>
