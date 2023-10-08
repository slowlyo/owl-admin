/// <reference types="vite/client" />

interface Window {
    $adminApiPrefix: string;
    $owl: {
        logout: () => void,
        refreshRoutes: () => Promise,
        appLoader: () => void,
        afterLoginSuccess: (params: any, token: string) => void,
        refreshAmisPage: () => Promise,
    }
}

declare module "*.css" {
    const classes: { [className: string]: string }
    export default classes
}

interface GlobalState {
    settings?: any;
    userInfo?: {
        name?: string;
        avatar?: string;
    };
    userLoading?: boolean;
    // 面包屑
    breadcrumb?: [],
    routes?: any[];
    // 初始化完成
    inited?: boolean;
    openSetting?: boolean;
    antdToken?: any;
}
