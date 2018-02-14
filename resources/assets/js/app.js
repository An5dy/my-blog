
window.Vue = require('vue');
/* vue-router */
import router from './router';

/* axios */
import './util/axios';

/* 设置element-ui，按需引入组件 */
import 'element-ui/lib/theme-chalk/index.css';
import Button from 'element-ui/lib/button';
import Container from 'element-ui/lib/container';
import Header from 'element-ui/lib/header';
import Aside from 'element-ui/lib/aside';
import Main from 'element-ui/lib/main';
import Menu from 'element-ui/lib/menu';
import Submenu from 'element-ui/lib/submenu';
import MenuItemGroup from 'element-ui/lib/menu-item-group';
import MenuItem from 'element-ui/lib/menu-item';
import Dropdown from 'element-ui/lib/dropdown';
import DropdownMenu from 'element-ui/lib/dropdown-menu';
import DropdownItem from 'element-ui/lib/dropdown-item';
import Table from 'element-ui/lib/table';
import TableColumn from 'element-ui/lib/table-column';
import Row from 'element-ui/lib/row';
import Col from 'element-ui/lib/col';
import Form from 'element-ui/lib/form';
import FormItem from 'element-ui/lib/form-item';
import Input from 'element-ui/lib/input';
import Message from 'element-ui/lib/message';
import Dialog from 'element-ui/lib/dialog';
import Tag from 'element-ui/lib/tag';
import Select from 'element-ui/lib/select';
import Option from  'element-ui/lib/option';
import Pagination from 'element-ui/lib/pagination';
Vue.use(Button);
Vue.use(Container);
Vue.use(Header);
Vue.use(Aside);
Vue.use(Main);
Vue.use(Menu);
Vue.use(Submenu);
Vue.use(MenuItemGroup);
Vue.use(MenuItem);
Vue.use(Dropdown);
Vue.use(DropdownMenu);
Vue.use(DropdownItem);
Vue.use(Table);
Vue.use(TableColumn);
Vue.use(Row);
Vue.use(Col);
Vue.use(Form);
Vue.use(FormItem);
Vue.use(Input);
Vue.use(Dialog);
Vue.use(Tag);
Vue.use(Select);
Vue.use(Option);
Vue.use(Pagination);
Vue.prototype.$message = Message;

import App from './App.vue';
const app = new Vue({
    el: '#app',
    router,
    template: '<App/>',
    components: { App }
});
