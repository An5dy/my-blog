window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/* 设置路由前缀 */
window.axios.baseURL = '/api';
/* 设置access_token */
import Cookie from 'js-cookie';
window.axios.defaults.headers.Accept = 'application/json';
window.axios.interceptors.request.use(function (config) {
    let admin = JSON.parse(Cookie.get('admin'));
    if (admin && admin.access_token) {
        config.headers['Authorization'] = 'Bearer ' + admin.access_token;
    }
    return config;
}, function (error) {
    return Promise.reject(error);
});
/* 登录失败 */
window.axios.defaults.transformResponse = data => {
    data = JSON.parse(data);
    if (data.code === '30000') {
        Cookie.remove('admin');
        window.vm.$router.push('/admin/login');
    }
    return data;
}
