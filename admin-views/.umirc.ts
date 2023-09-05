import {defineConfig} from 'umi'

export default defineConfig({
    routes: [
        {path: '/', component: 'index'},
        {path: '/login', component: 'login', layout: false},
    ],

    npmClient: 'pnpm',
    tailwindcss: {},
    plugins: [
        '@umijs/plugins/dist/tailwindcss',
        '@umijs/plugins/dist/request',
    ],
    request:{}
})
