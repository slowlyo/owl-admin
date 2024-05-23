import {getCacheKey, mergeObject} from '@/utils/common'

// 默认设置
const defaultSettings = {
    darkTheme: false,
    footer: false,
    breadcrumb: true,
    themeColor: '#1677ff',
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
    tabIcon: true,
    accordionMenu: false,
    locale: 'zh_CN',
}

// 默认 token
const defaultToken = {
    token: {
        wireframe: true,
        colorSplit: 'var(--color-border)',
    },
    components: {
        Menu: {
            iconSize: 18,
            collapsedIconSize: 18,
            itemMarginInline: 8,
            subMenuItemBg: 'transparent',
        }
    }
}

// 初始状态
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
            if (userInfo?.name) {
                localStorage.setItem(getCacheKey('user_name'), userInfo?.name || '')
            }
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
            const result = JSON.parse(JSON.stringify(mergeObject(state.settings, settings)))
            localStorage.setItem(getCacheKey('settings'), JSON.stringify(result))
            return {
                ...state,
                settings: result,
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
