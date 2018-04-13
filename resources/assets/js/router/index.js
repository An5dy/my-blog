import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

let routes = [
    {
        path: '/admin',
        component: require('../components/Content/Content'),
        children: [
            {
                path: '',
                component: require('../components/Article/Article'),
            },
            {
                path: 'articles/add',
                component: require('../components/Article/ArticleAdd'),
            },
            {
                path: 'articles/:id/edit',
                component: require('../components/Article/ArticleAdd'),
            },
            {
                path: 'thoughts',
                component: require('../components/Thought/Thought'),
            },
            {
                path: 'thoughts/add',
                component: require('../components/Thought/ThoughtAdd'),
            },
            {
                path: 'thoughts/:id/edit',
                component: require('../components/Thought/ThoughtAdd'),
            },
            {
                path: 'categories',
                component: require('../components/Category/Category'),
            },
            {
                path: 'categories/add',
                component: require('../components/Category/CategoryAdd'),
            },
            {
                path: 'links',
                component: require('../components/Link/Link'),
            },
            {
                path: 'links/add',
                component: require('../components/Link/LinkAdd'),
            },
            {
                path: 'about',
                component: require('../components/About/About'),
            }
        ]
    },
    {
        path: '/admin/login',
        component: require('../components/Login/Login'),
    }
];

const router = new Router({
    mode: 'history',
    routes
});

export default router