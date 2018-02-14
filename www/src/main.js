import Vue from 'vue'
import App from './App'
import router from './router'
import './util/axios'

/* font-awesome字体库 */
import 'vue-awesome/icons/github'
import 'vue-awesome/icons/weibo'
import 'vue-awesome/icons/fire'
import 'vue-awesome/icons/leaf'
import 'vue-awesome/icons/handshake-o'
import Icon from 'vue-awesome/components/Icon'
Vue.component('Icon', Icon)

/* 设置element-ui，按需引入组件 */
import 'element-ui/lib/theme-chalk/index.css'
import Row from 'element-ui/lib/row'
import Col from 'element-ui/lib/col'
import Container from 'element-ui/lib/container'
import Header from 'element-ui/lib/header'
import Main from 'element-ui/lib/main'
import Footer from 'element-ui/lib/footer'
import Input from 'element-ui/lib/input'
import Card from 'element-ui/lib/card'
import Tag from 'element-ui/lib/tag'
import Pagination from 'element-ui/lib/pagination'
import Tooltip from 'element-ui/lib/tooltip'
import Button from 'element-ui/lib/button'
import Message from 'element-ui/lib/message'
Vue.use(Row)
Vue.use(Col)
Vue.use(Container)
Vue.use(Header)
Vue.use(Footer)
Vue.use(Main)
Vue.use(Input)
Vue.use(Card)
Vue.use(Tag)
Vue.use(Pagination)
Vue.use(Tooltip)
Vue.use(Button)
Vue.prototype.$message = Message

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
