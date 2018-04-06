<template>
    <transition name="sidebar-slide-fade">
        <div class="sidebar">
            <el-card class="user-info">
                <div class="avatar">
                    <img src="../../../../assets/avatar.png">
                </div>
                <ul class="contacts">
                    <li>
                        <a href="https://github.com/And1yZhang" target="_blank">
                            <icon name="github"></icon>
                        </a>
                    </li>
                    <li>
                        <a href="https://weibo.com/u/5244193765?refer_flag=1001030201_" target="_blank">
                            <icon name="weibo"></icon>
                        </a>
                    </li>
                </ul>
            </el-card>
            <el-card class="newest-list">
                <div slot="header">
                    <icon name="leaf" style="color: #67C23A"></icon>
                    <span>最新文章</span>
                    <el-button type="text" @click="getMore">查看更多</el-button>
                </div>
                <div
                        v-for="article in articles"
                        :key="article.id">
                    <router-link
                            :to="{ name: 'show', params: { id: article.id }}">{{ article.title }}</router-link>
                </div>
            </el-card>
            <el-card class="friendly-links">
                <div slot="header">
                    <icon name="handshake-o" style="color: #409EFF"></icon>
                    <span>友情链接</span>
                </div>
                <div
                        v-for="link in links"
                        :key="link.id">
                    <a :href="link.path" target="_blank">{{ link.description }}</a>
                </div>
            </el-card>
        </div>
    </transition>
</template>

<script>
    export default {
        name: 'AppSidebar',
        data() {
            return {
                articles: [],
                links: [],
            }
        },
        methods: {
            getSidebars() {
                this.axios.get('/sidebars')
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.articles = response.data.data.articles
                            this.links = response.data.data.links
                        }
                    })
            },
            getMore() {
                this.$router.push('/articles/newest')
            }
        },
        mounted() {
            this.getSidebars()
        }
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "AppSidebar.less";
</style>
