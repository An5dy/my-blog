<template>
    <el-container class="body">
        <app-header></app-header>
        <main>
            <router-view/>
        </main>
        <app-footer></app-footer>
    </el-container>
</template>

<script>
    import { AppHeader, AppFooter } from 'Commons'
    export default {
        name: 'Content',
        mounted() {
        },
        components: {
            AppHeader,
            AppFooter
        }
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "Content.less";
</style>
