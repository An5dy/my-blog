import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)
/* 设置axios */
axios.defaults.baseURL = '/api'// 设置接口前缀
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'// 设置X-Requested-With
axios.defaults.headers.Accept = 'application/json'// 设置accept