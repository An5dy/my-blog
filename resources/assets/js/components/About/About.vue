<template>
    <el-form :label-position="labelPosition" label-width="80px" :model="about">
        <el-form-item label="关于">
            <mavon-editor
                    ref='md'
                    v-model="about.markdown"
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
        name: 'About',
        data() {
            return {
                about: {
                    id: 0,
                    markdown: '',
                },
                labelPosition: 'right',
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
                this.axios.post('/admin/about', this.about)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.about = response.data.data;
                            this.$message.success('发布成功');
                        } else {
                            this.$message.error('发布失败');
                        }
                    }).catch(error => {
                        this.$message.error('发布失败');
                });
            },
            getAbout() {
                this.axios.get('/admin/about')
                    .then(response => {
                        if (response.data.data) {
                            this.about = response.data.data;
                        }
                    });
            }
        },
        mounted() {
            this.getAbout();
        },
        components: {
            'mavon-editor': mavonEditor
        },
    }
</script>

<style>
</style>
