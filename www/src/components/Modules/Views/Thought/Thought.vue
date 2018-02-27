<template>
    <transition name="bounce">
        <el-container class="thought" v-if="show">
            <el-main class="main">
                <el-card
                        class="thought-card"
                        v-for="(thought, index) in thoughts"
                        :key="index">
                    <div class="thought-card-title">
                        <router-link
                        :to="{ name: 'thoughtShow', params: { id: thought.id }}">
                        {{thought.title}}
                        </router-link>
                    </div>
                    <div class="thought-card-time">
                        {{thought.created_at}}
                    </div>
                </el-card>
            </el-main>
        </el-container>
    </transition>
</template>

<script>
    export default {
        name: 'Thought',
        data() {
            return {
                thoughts: [],
                show: false,
            }
        },
        methods: {
            getThoughts() {
                this.axios.get('/thoughts')
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.thoughts = response.data.data
                            this.show = true
                        }
                    })
            }
        },
        mounted() {
            this.getThoughts()
        },
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "Thought.less";
</style>
