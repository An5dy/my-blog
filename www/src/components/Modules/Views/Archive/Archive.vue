<template>
    <transition name="bounce">
        <el-container class="archive" v-if="show">
            <el-main class="main">
                <div
                        class="archive-items"
                        v-for="(items, index) in archives"
                        :key="index">
                    <div class="archive-item">
                        <div class="archive-item-time">
                            <span>#</span> {{index}}
                        </div>
                        <el-card
                                class="archive-card"
                                v-for="item in items"
                                :key="item.id">
                            <div class="archive-card-title">
                                <router-link
                                        :to="{ name: 'show', params: { id: item.id }}">
                                    {{item.title}}
                                </router-link>
                            </div>
                            <div class="archive-card-time">
                                {{item.created_at}}
                            </div>
                        </el-card>
                    </div>
                </div>
            </el-main>
        </el-container>
    </transition>
</template>

<script>
    export default {
        name: 'Archive',
        data() {
            return {
                archives: [],
                show: false,
            }
        },
        methods: {
            getArchives() {
                this.axios.get('/archives')
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.archives = response.data.data
                            this.show = true
                        }
                    })
            }
        },
        mounted() {
            this.getArchives()
        },
    }
</script>

<style lang="less" scoped ref="stylesheet/less">
    @import "Archive.less";
</style>
