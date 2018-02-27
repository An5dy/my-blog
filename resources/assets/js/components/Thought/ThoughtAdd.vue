<template>
    <el-form :label-position="labelPosition" label-width="80px" :model="thought">
        <el-form-item label="标题">
            <el-input
                    v-model="thought.title"
                    size="small"></el-input>
        </el-form-item>
        <el-form-item label="正文">
            <mavon-editor
                    ref='md'
                    v-model="thought.markdown"
                    @imgAdd="imgAdd"
                    :toolbars="toolbars"></mavon-editor>
        </el-form-item>
        <el-form-item>
            <el-button
                    @click="onSubmit"
                    size="small"
                    type="primary">确认发布</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import { mavonEditor } from 'mavon-editor';
    import 'mavon-editor/dist/css/index.css';
    export default {
        name: 'ThoughtAdd',
        data() {
            return {
                labelPosition: 'right',
                thought: {
                    title: '',
                    markdown: '',
                },
                toolbars: {
                    bold: true, // 粗体
                    italic: true, // 斜体
                    header: true, // 标题
                    strikethrough: true, // 中划线
                    quote: true, // 引用
                    ol: true, // 有序列表
                    ul: true, // 无序列表
                    link: true, // 链接
                    imagelink: true, // 图片链接
                    code: true, // code
                    table: true, // 表格
                    fullscreen: true, // 全屏编辑
                    readmodel: false, // 沉浸式阅读
                    htmlcode: true, // 展示html源码
                    help: true, // 帮助
                    /* 1.3.5 */
                    undo: true, // 上一步
                    redo: true, // 下一步
                    trash: true, // 清空
                    save: true, // 保存（触发events中的save事件）
                    /* 1.4.2 */
                    navigation: true, // 导航目录
                    /* 2.1.8 */
                    alignleft: true, // 左对齐
                    aligncenter: true, // 居中
                    alignright: true, // 右对齐
                    /* 2.2.1 */
                    subfield: true, // 单双栏模式
                    preview: true, // 预览
                },
                editor: {},
            }
        },
        methods: {
            /* 图片上传 */
            imgAdd(pos, $file) {
                let formData = new FormData();
                formData.append('image', $file);
                this.axios({
                    url: '/admin/uploads',
                    method: 'post',
                    data: formData,
                    headers: { 'Content-Type': 'multipart/form-data' },
                }).then(response => {
                    this.$refs.md.$img2Url(pos, response.data.data.pop());
                })
            },
            onSubmit() {
                let url = '/admin/thoughts';
                if (this.$route.params.id > 0) {
                    url = url + '/update/' +  this.$route.params.id;
                }
                this.axios.post(url, this.thought)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.$message.success('发布成功');
                            this.$router.push('/admin/thoughts');
                        } else {
                            this.$message.error('发布失败');
                        }
                    });
            },
            getThought() {
                if (this.$route.params.id) {
                    console.log(this.$route.params.id)
                    this.axios.get('/admin/thoughts/edit/' + this.$route.params.id)
                        .then(response => {
                            if (response.data.code === '10000') {
                                this.thought = response.data.data;
                            } else {
                                this.$message.error(response.data.message);
                                this.$router.push('/thoughts');
                            }
                        });
                }
            }
        },
        watch: {
            '$route' (to, from) {
                this.thought = {};
            }
        },
        mounted() {
            this.getThought();
        },
        components: {
            'mavon-editor': mavonEditor
        },
    }
</script>

<style>
</style>
