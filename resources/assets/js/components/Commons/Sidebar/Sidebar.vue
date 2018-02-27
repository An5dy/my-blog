<template>
    <el-menu
             router>
        <el-submenu index="1">
            <template slot="title"><i class="el-icon-document"></i>文章管理</template>
            <el-menu-item index="/admin">文章列表</el-menu-item>
            <el-menu-item index="/admin/articles/add">发布文章</el-menu-item>
        </el-submenu>
        <el-submenu index="2">
            <template slot="title"><i class="el-icon-document"></i>随想管理</template>
            <el-menu-item index="/admin/thoughts">随想列表</el-menu-item>
            <el-menu-item index="/admin/thoughts/add">发布随想</el-menu-item>
        </el-submenu>
        <el-submenu index="3">
            <template slot="title"><i class="el-icon-menu"></i>分类管理</template>
            <el-menu-item index="/admin/categories">分类列表</el-menu-item>
            <el-menu-item index="/admin/categories/add">新增分类</el-menu-item>
        </el-submenu>
        <el-submenu index="4">
            <template slot="title"><i class="el-icon-setting"></i>链接管理</template>
            <el-menu-item index="/admin/links">链接列表</el-menu-item>
            <el-menu-item index="/admin/links/add">新增链接</el-menu-item>
        </el-submenu>
        <el-submenu index="5">
            <template slot="title"><i class="el-icon-setting"></i>关于</template>
            <el-menu-item index="/admin/about">关于</el-menu-item>
        </el-submenu>
    </el-menu>
</template>

<script>
    export default {
        name: 'Sidebar'
    }
</script>

<style>
</style>
