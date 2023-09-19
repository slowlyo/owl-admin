import {getCacheKey} from '@/utils/common'

const defaultSettings = {
    footer: false,
    breadcrumb: true,
    breadcrumbIcon: false,
    themeColor: '#1677ff',
    menuWidth: 220,
    layoutMode: 'default',
    siderTheme: 'light',
    topTheme: 'light',
    animateInType: 'alpha',
    animateInDuration: 600,
    animateOutType: 'alpha',
    animateOutDuration: 600,
    loginTemplate: 'default',
    keepAlive: false,
    enableTab: false,
    tabIcon: true
}

const defaultToken = {
    token: {
        borderRadius: 4,
        wireframe: true,
        colorSplit: 'var(--color-border)',
    },
    components: {
        Menu: {
            iconSize: 18,
            collapsedIconSize: 18,
            subMenuItemBg: '#fff',
            darkSubMenuItemBg: '#001529',
            itemMarginInline: 8,
        }
    }
}

export interface GlobalState {
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

const initialState: GlobalState = {
    settings: {
        system_theme_setting: defaultSettings
    },
    userInfo: {},
    routes: [],
    userLoading: false,
    inited: false,
    openSetting: false,
    antdToken: defaultToken,
}

export default function store(state = initialState, action) {
    switch (action.type) {
        case 'update-userInfo': {
            const {userInfo = initialState.userInfo, userLoading} = action.payload
            return {
                ...state,
                userLoading,
                userInfo,
            }
        }
        case 'update-breadcrumb': {
            const {breadcrumb} = action.payload
            return {
                ...state,
                breadcrumb,
            }
        }
        case 'update-settings': {
            const {settings} = action.payload
            localStorage.setItem(getCacheKey('settings'), JSON.stringify(settings))
            return {
                ...state,
                settings,
            }
        }
        case 'update-routes': {
            const {routes} = action.payload
            return {
                ...state,
                routes,
            }
        }
        case 'update-inited': {
            const {inited} = action.payload
            return {
                ...state,
                inited,
            }
        }
        case 'update-open-setting': {
            const {openSetting} = action.payload
            return {
                ...state,
                openSetting,
            }
        }
        case 'update-antd-token': {
            const {antdToken} = action.payload
            return {
                ...state,
                antdToken,
            }
        }
        default:
            return state
    }
}
