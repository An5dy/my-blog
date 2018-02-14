<template>
    <div>
        <el-table
                :data="articles"
                height="500"
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="ID"
                    align="center"
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="category.title"
                    label="分类"
                    align="center"
                    width="100">
            </el-table-column>
            <el-table-column
                    label="标签"
                    prop="tags"
                    align="center">
                <template slot-scope="scope">
                    <el-tag
                            v-for="(tag, index) in scope.row.tags"
                            :key="index"
                            closable
                            size="mini"
                            style="margin-right: 5px"
                            @close="handleClose(index, scope.row.tags)"
                            type="primary">{{tag.title}}</el-tag>
                </template>
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
        name: 'Article',
        data() {
            return {
                articles: [],
                total: 0,
                currentPage: 1,
                pageSize: 10,
            }
        },
        methods: {
            getArticles() {
                this.axios.get('/admin/articles?page=' + this.currentPage)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.articles = response.data.data;
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
                this.getArticles();
            },
            handleDelete(index, row) {
                this.axios.post('/admin/articles/' + row.id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.articles.splice(index, 1);
                            this.$message.success('删除成功');
                            this.getArticles();
                        } else {
                            this.$message.error('删除失败');
                        }
                    })
            },
            handleEdit(index, row) {
                this.$router.push('/admin/articles/edit/' + row.id);
            },
            handleClose(index, tags) {
                this.axios.post('/admin/tags/' + tags[index].id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            tags.splice(index, 1);
                            this.$message.success('删除成功');
                        } else {
                            this.$message.error('删除失败');
                        }
                    });
            },
            filterTag(value, row) {
                return row.tag === value;
            }
        },
        mounted() {
            this.getArticles();
        }
    }
</script>

<style scoped lang="css" ref="stylesheet/css">
    .pagination {
        text-align: center;
        margin-top: 20px;
    }
</style>
