<template>
    <transition name="bounce">
        <el-container class="article" v-if="show">
            <el-main class="article-main">
                <div class="title">
                    <h2>{{article.title}}</h2>
                </div>
                <div class="meta">
                    <i> {{article.published_at}}</i>
                    <i class="el-icon-menu"> {{article.category.title}}</i>
                    <i class="el-icon-view"> {{article.checked_num}}</i>
                </div>
                <div
                        v-html="article.description"
                        class="content"></div>
                <div class="other">
                    <el-tag
                            v-for="tag in article.tags"
                            :key="tag.id">{{tag.title}}</el-tag>
                </div>
            </el-main>
        </el-container>
    </transition>
</template>

<script>
    export default {
        name: 'ArticleShow',
        data() {
            return {
                article: {
                    category: {},
                    tags: [],
                },
                show: false,
            }
        },
        methods: {
            getArticle() {
                this.axios.get('/articles/' + this.$route.params.id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.article = response.data.data
                            this.article.tags = response.data.data.tags
                            this.article.category = response.data.data.category
                            this.show = true
                            document.title = this.article.title
                        } else {
                            this.$message.error('当前文章不存在')
                            this.$router.push('/')
                        }
                    })
            }
        },
        mounted() {
            this.getArticle()
        }
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "ArticleShow.less";
</style>
