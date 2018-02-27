import Vue from 'vue'
import Router from 'vue-router'
/* nprogress进度条 */
import Nprogress from 'nprogress'
import 'nprogress/nprogress.css'
/* 组件 */
import Components from '../components'

Vue.use(Router)
/* 设置路由 */
let routes = [
    {
        path: '/',
        component: Components.Modules.Content,
        children: [
            {
                path: '',
                name: 'home',
                component: Components.Modules.Views.Home,
                meta: {
                    title: '首页'
                }
            },
            {
                path: 'search',
                name: 'search',
                component: Components.Modules.Views.Home,
                meta: {
                    title: '搜索'
                }
            },
            {
                path: 'articles/newest',
                'name': 'newest',
                component: Components.Modules.Views.Home,
                meta: {
                    title: '最新文章'
                }
            },
            {
                path: 'articles/:id',
                name: 'show',
                component: Components.Modules.Views.ArticleShow,
                meta: {
                    title: '详情'
                }
            },
            {
                path: 'archives',
                name: 'archive',
                component: Components.Modules.Views.Archive,
                meta: {
                    title: '归档'
                }
            },
            {
                path: 'about',
                name: 'about',
                component: Components.Modules.Views.About,
                meta: {
                    title: '关于'
                }
            },
            {
                path: 'thoughts',
                name: 'thoughts',
                component: Components.Modules.Views.Thought,
                meta: {
                    title: '随想'
                }
            }
        ]
    },
    {
        path: '*',
        name: '404',
        component: Components.Error,
        meta: {
            title: '404'
        }
    }
]
/* 设置路由 */
const router = new Router({
    mode: 'history',
    scrollBehavior: () => ({
        y: 0
    }),
    routes
})
router.beforeEach((to, from, next) => {
    window.scroll(0, 0)
    /* 加载进度条 */
    Nprogress.start()
    if (to.meta.title) {
        document.title = to.meta.title
    }
    next()
})
router.afterEach(() => {
    /* 结束进度条 */
    Nprogress.done()
})
export default router
