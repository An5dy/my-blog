<template>
    <transition name="bounce">
        <el-container class="thought" v-if="show">
            <el-main class="thought-main">
                <div class="title">
                    <h2>{{thought.title}}</h2>
                </div>
                <div class="meta">
                    <i> {{thought.created_at}}</i>
                </div>
                <div
                        v-html="thought.description"
                        class="content"></div>
            </el-main>
        </el-container>
    </transition>
</template>

<script>
    export default {
        name: 'ThoughtShow',
        data() {
            return {
                thought: {},
                show: false
            }
        },
        methods: {
            getThought() {
                this.axios.get('/thoughts/' + this.$route.params.id)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.thought = response.data.data
                            this.show = true
                            document.title = this.thought.title
                        } else {
                            this.$message.error('当前文章不存在')
                            this.$router.push('/')
                        }
                    })
            }
        },
        mounted() {
            this.getThought()
        }
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "ThoughtShow.less";
</style>
