<template>
    <transition name="bounce">
        <el-container class="about" v-if="show">
            <el-main class="main">
                <div
                        v-html="about.description"
                ></div>
            </el-main>
        </el-container>
    </transition>
</template>

<script>
    export default {
        name: 'About',
        data() {
            return {
                show: false,
                about: {}
            }
        },
        methods: {
            getAbout() {
                this.axios.get('/about')
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.about = response.data.data
                            this.show = true
                        } else {
                            this.$message.error('出错了')
                            this.$router.push('/')
                        }
                    })
            }
        },
        mounted() {
            this.getAbout()
        }
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "About.less";
</style>
