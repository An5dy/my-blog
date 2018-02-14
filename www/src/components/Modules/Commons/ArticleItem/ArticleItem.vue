<template>
    <el-card class="article">
        <div class="title">
            <h3>
                <router-link
                        :to="{ name: 'show', params: { id: article.id }}">
                    <span v-html="article.title"></span>
                </router-link>
            </h3>
        </div>
        <div class="meta">
            <ul>
                <li>
                    <i class="el-icon-date"> {{ article.created_at }}</i>
                </li>
                <li>
                    <router-link to="/">
                        <i class="el-icon-menu"> {{ article.category.title }}</i>
                    </router-link>
                </li>
                <li>
                    <i class="el-icon-view"> {{ article.checked_num }}</i>
                </li>
            </ul>
        </div>
        <div class="description">
            <p>
                {{ article.description }}
            </p>
        </div>
        <div class="other">
            <el-tag
                    v-for="tag in article.tags"
                    :key="tag.id"
                    style="margin-right: 5px"
                    size="small">{{ tag.title }}</el-tag>
            <router-link
                    :to="{ name: 'show', params: { id: article.id }}"
                    class="read-all">阅读全文</router-link>
        </div>
    </el-card>
</template>

<script>
    export default {
        name: 'ArticleItem',
        props: {
            article: {},
        },
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "ArticleItem.less";
</style>
