import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Cookie from 'js-cookie';
import router from '../router/index';

Vue.use(VueAxios, axios);
axios.defaults.baseURL = '/api';
// 设置X-Requested-With
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/* 设置access */
axios.defaults.headers.Accept = 'application/json';
// 设置token
axios.interceptors.request.use(function (config) {
    let admin = Cookie.get('admin');
    if (admin) {
        admin = JSON.parse(admin);
        config.headers['Authorization'] = 'Bearer ' + admin.access_token;
    }
    return config;
}, function (error) {
    return Promise.reject(error);
});
/* 设置access_token过期操作 */
axios.defaults.transformResponse = data => {
    data = JSON.parse(data);
    if (data.code === '30000') {
        Cookie.remove('admin');
        router.push('/admin/login');
    }
    return data;
}
