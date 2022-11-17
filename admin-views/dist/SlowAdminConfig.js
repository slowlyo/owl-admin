window.slowAdminConfig = {
    // 登录成功后跳转的页面
    loginSuccessRedirect: '/admin',
    // 登录页面背景, run start 时可能不会显示
    loginBackground: '/admin/login-bg.png',
    // 是否启用主题修改工具
    themeSettingDrawer: false,
    // 布局配置, 跟多配置请查看 https://procomponents.ant.design/components/layout
    layoutSetting: {
        /**
         * 主题色 可以用名称或者颜色值
         * @default '#1890ff'
         *
         * daybreak: #1890ff
         * dust: #F5222D
         * volcano: #FA541C
         * sunset: #FAAD14
         * cyan: #13C2C2
         * green: #52C41A
         * geekblue: #2F54EB
         * purple: #722ED1
         */
        colorPrimary: 'daybreak',
        // 整体风格 light , realDark
        navTheme: 'light',
        // 导航模式: side, top, mix
        layout: 'mix',
        // 内容区宽度 'Fluid' | 'Fixed'
        contentWidth: 'Fluid',
        // 固定 Header
        fixedHeader: false,
        // 固定侧边栏
        fixSiderbar: true,
        // 色弱模式
        colorWeak: false,
        pwa: false,
        iconfontUrl: '',
    }
}
