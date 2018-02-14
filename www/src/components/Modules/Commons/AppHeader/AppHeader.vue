<template>
    <header ref="header">
        <div class="header">
            <el-row :gutter="20">
                <el-col :span="8">
                    <div class="logo">
                        <router-link to="/">SEE THE FUTURE</router-link>
                    </div>
                </el-col>
                <el-col :span="4" :offset="6">
                    <div class="search">
                        <i class="el-icon-search search-icon"></i>
                        <input
                                type="text"
                                class="search-input"
                                v-model.trim="searchValue"
                                @keyup.enter="onSearch(searchValue)">
                    </div>
                </el-col>
                <el-col :span="2">
                    <div>
                        <router-link to="/">首页</router-link>
                    </div>
                </el-col>
                <el-col :span="2">
                    <div>
                        <router-link to="/archives">归档</router-link>
                    </div>
                </el-col>
                <el-col :span="2">
                    <div>
                        <router-link to="/about">关于</router-link>
                    </div>
                </el-col>
            </el-row>
        </div>
    </header>
</template>

<script>
    import AppHeader from './AppHeader'
    export default AppHeader
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "AppHeader.less";
</style>
