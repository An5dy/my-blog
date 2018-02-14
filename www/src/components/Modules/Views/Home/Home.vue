<template>
    <el-row :gutter="20">
        <el-col :span="16" class="article-list">
            <transition-group name="list" tag="div">
                <article-item
                        v-for="(article, index) in articles"
                        :article="article"
                        :key="article.id"></article-item>
            </transition-group>
            <el-pagination
                    class="pagination"
                    background
                    layout="prev, pager, next"
                    @current-change="handleCurrentChange"
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    :total="total">
            </el-pagination>
        </el-col>
        <el-col :span="8">
            <app-sidebar></app-sidebar>
        </el-col>
    </el-row>
</template>

<script>
    import { AppSidebar, ArticleItem } from 'Commons'
    export default {
        name: 'Home',
        data() {
            return {
                data: [1,2,3],
                articles: [],
                currentPage: 1,
                pageSize: 10,
                total: 0,
            }
        },
        watch: {
            '$route' (to, from) {
                this.currentPage = 1
                this.getArticles()
            }
        },
        methods: {
            getArticles() {
                let params = { page: this.currentPage }
                if (this.$route.path === '/search' && this.$route.query.title != null) {
                    params['title'] = this.$route.query.title
                }
                if (this.$route.path === '/articles/newest') {
                    params['orderBy'] = 'created_at'
                }
                this.axios.get('/articles', { params: params })
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.articles = response.data.data
                            this.total = response.data.meta.total
                            this.currentPage = response.data.meta.current_page
                            this.pageSize = response.data.meta.per_page
                        }
                    })
            },
            handleCurrentChange(val) {
                this.currentPage = val
                this.getArticles()
            }
        },
        mounted() {
            this.getArticles()
        },
        components: {
            AppSidebar: AppSidebar,
            ArticleItem: ArticleItem
        },
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "Home.less";
</style>
