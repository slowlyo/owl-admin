const defaultSettings = {
    footer: false,
    breadcrumb: true,
    breadcrumbIcon: false,
    themeColor: '#4080FF',
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

export interface GlobalState {
    settings?: {};
    userInfo?: { name?: string; avatar?: string; };
    breadcrumb?: [],
    routes?: any[];
}

const initialState: GlobalState = {
    settings: {},
    userInfo: {},
    routes: [],
}

export default function store(state = initialState, action) {
    switch (action.type) {
        case 'update-settings': {
            const {settings} = action.payload

            settings.system_theme_setting = {
                ...settings.system_theme_setting,
                ...defaultSettings,
            }

            return {
                ...state,
                settings,
            }
        }
        case 'update-userInfo': {
            const {userInfo = initialState.userInfo} = action.payload
            return {
                ...state,
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
        case 'update-routes': {
            const {routes} = action.payload
            return {
                ...state,
                routes,
            }
        }
        default:
            return state
    }
}
