export default {
    '/admin-api/': {
        // 要代理的地址
        target: 'http://owl-admin.test',
        changeOrigin: true,
    },
}
