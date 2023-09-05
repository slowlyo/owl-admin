import {defineConfig} from 'umi'

const isDev = process.env.NODE_ENV === 'development'

const proxy: any = isDev ? {
    '/admin-api/': {
        target: 'http://owl-admin.test',
        changeOrigin: true,
    },
} : {}

export default defineConfig({
    routes: [
        {path: '/', component: 'index'},
        {path: '/login', component: 'login', layout: false},
    ],

    base: isDev ? '' : '/admin',
    history: {
        type: 'hash'
    },
    npmClient: 'pnpm',
    plugins: [
        '@umijs/plugins/dist/tailwindcss',
        '@umijs/plugins/dist/request',
        '@umijs/plugins/dist/initial-state',
        '@umijs/plugins/dist/model',
    ],
    tailwindcss: {},
    request: {},
    model: {},
    initialState: {},
    proxy
})
