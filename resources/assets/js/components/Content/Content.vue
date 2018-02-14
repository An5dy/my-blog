<template>
    <el-container>
        <app-header></app-header>
        <el-container>
            <el-aside width="200px">
                <app-sidebar></app-sidebar>
            </el-aside>
            <el-main>
                <router-view></router-view>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
    import Header from '../Commons/Header/Header';
    import Sidebar from '../Commons/Sidebar/Sidebar';
    export default {
        name: 'Content',
        data() {
            return {
                tableData: [{
                    date: '2016-05-02',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-04',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1517 弄'
                }, {
                    date: '2016-05-01',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1519 弄'
                }, {
                    date: '2016-05-03',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1516 弄'
                }]
            }
        },
        components: {
            'app-header': Header,
            'app-sidebar': Sidebar,
        }
    }
</script>

<style scoped lang="css" ref="stylesheet/css">
    .el-aside {
        position: absolute;
        top: 60px;
        left:0;
        height: 100%;
        overflow:auto;
        background-color: white;
        border-right: 1px solid #e6e6e6;
    }
    .el-aside ul {
        border: none;
    }
    .el-main {
        position: absolute;
        top: 60px;
        right: 0px;
        left: 200px;
        background-color: white;
        height: 100%;
        z-index: 2;
    }
</style>
