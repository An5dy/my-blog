<template>
    <el-form :label-position="labelPosition" label-width="80px" :model="article">
        <el-form-item label="标题">
            <el-input
                    v-model="article.title"
                    size="small"></el-input>
        </el-form-item>
        <el-form-item label="正文">
            <mavon-editor
                    ref='md'
                    v-model="article.markdown"
                    @imgAdd="imgAdd"
                    :toolbars="toolbars"></mavon-editor>
        </el-form-item>
        <el-form-item label="标签">
            <el-tag
                    v-for="tag in article.tags"
                    :key="tag"
                    closable
                    :disable-transitions="false"
                    @close="handleClose(tag)">
                {{tag}}
            </el-tag>
            <el-input
                    class="input-new-tag"
                    v-if="inputVisible"
                    v-model.trim="inputValue"
                    ref="saveTagInput"
                    size="small"
                    @keyup.enter.native="handleInputConfirm"
                    @blur="handleInputConfirm"
            >
            </el-input>
            <el-button
                    v-else
                    class="button-new-tag"
                    size="small"
                    @click="showInput">+ 新增标签</el-button>
        </el-form-item>
        <el-form-item label="分类">
            <el-select
                    v-model="article.category"
                    size="small"
                    placeholder="请选择分类">
                <el-option
                        v-for="category in categories"
                        :label="category.title"
                        :value="category.id"
                        :key="category.id"></el-option>
            </el-select>
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
        name: 'ArticleAdd',
        data() {
            return {
                labelPosition: 'right',
                inputVisible: false,
                inputValue: '',
                value: '',
                article: {
                    title: '',
                    category: '',
                    markdown: '',
                    tags: [],
                },
                categories: [],
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
            handleClose(tag) {
                this.article.tags.splice(this.article.tags.indexOf(tag), 1);
            },
            showInput() {
                if (this.article.tags.length >= 5) {
                    this.$message.warning('标签最多添加5个');
                    return;
                }
                this.inputVisible = true;
                this.$nextTick(_ => {
                    this.$refs.saveTagInput.$refs.input.focus();
                });
            },
            handleInputConfirm() {
                if (this.article.tags.includes(this.inputValue)) {
                    this.$message.warning('当前标签已添加');
                    return;
                }
                let inputValue = this.inputValue;
                if (inputValue) {
                    this.article.tags.push(inputValue);
                }
                this.inputVisible = false;
                this.inputValue = '';
            },
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
            getCategories() {
                this.axios.post('/admin/categories/list')
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.categories = response.data.data;
                        }
                    });
            },
            onSubmit() {
                let url = '/admin/articles';
                if (this.$route.params.id > 0) {
                    url = url + '/update/' +  this.$route.params.id;
                }
                this.axios.post(url, this.article)
                    .then(response => {
                        if (response.data.code === '10000') {
                            this.$message.success('发布成功');
                            this.$router.push('/admin');
                        } else {
                            this.$message.error('发布失败');
                        }
                    });
            },
            getArticle() {
                if (this.$route.params.id) {
                    this.axios.get('/admin/articles/edit/' + this.$route.params.id)
                        .then(response => {
                            if (response.data.code === '10000') {
                                this.article = response.data.data;
                                this.article.category = response.data.data.category_id;
                                for (let key in this.article.tags) {
                                    this.article.tags[key] = this.article.tags[key].title;
                                }
                            } else {
                                this.$message.error(response.data.message);
                                this.$router.push('/admin');
                            }
                        });
                }
            }
        },
        watch: {
            '$route' (to, from) {
                this.article = {}
            }
        },
        mounted() {
            this.getCategories();
            this.getArticle();
        },
        components: {
            'mavon-editor': mavonEditor
        },
    }
</script>

<style scoped lang="css" ref="stylesheet/css">
    .el-tag + .el-tag {
        margin-left: 10px;
    }
    .button-new-tag {
        margin-left: 10px;
        height: 32px;
        line-height: 30px;
        padding-top: 0;
        padding-bottom: 0;
    }
    .input-new-tag {
        width: 90px;
        margin-left: 10px;
        vertical-align: bottom;
    }
</style>
