webpackJsonp([2],{lrtZ:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i={name:"ArticleShow",data:function(){return{article:{category:{},tags:[]},show:!1}},methods:{getArticle:function(){var t=this;this.axios.get("/articles/"+this.$route.params.id).then(function(e){"10000"===e.data.code?(t.article=e.data.data,t.article.tags=e.data.data.tags,t.article.category=e.data.data.category,t.show=!0,document.title=t.article.title):(t.$message.error("当前文章不存在"),t.$router.push("/"))})}},mounted:function(){this.getArticle()}},s={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("transition",{attrs:{name:"bounce"}},[t.show?a("el-container",{staticClass:"article"},[a("el-main",{staticClass:"article-main"},[a("div",{staticClass:"title"},[a("h2",[t._v(t._s(t.article.title))])]),t._v(" "),a("div",{staticClass:"meta"},[a("i",[t._v(" "+t._s(t.article.published_at))]),t._v(" "),a("i",{staticClass:"el-icon-menu"},[t._v(" "+t._s(t.article.category.title))]),t._v(" "),a("i",{staticClass:"el-icon-view"},[t._v(" "+t._s(t.article.checked_num))])]),t._v(" "),a("div",{staticClass:"content",domProps:{innerHTML:t._s(t.article.description)}}),t._v(" "),a("div",{staticClass:"other"},t._l(t.article.tags,function(e){return a("el-tag",{key:e.id},[t._v(t._s(e.title))])}))])],1):t._e()],1)},staticRenderFns:[]},c=a("VU/8")(i,s,!1,function(t){a("u/jP")},"data-v-c891c5be",null);e.default=c.exports},"u/jP":function(t,e){}});