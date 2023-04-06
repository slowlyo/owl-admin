import defaultSettings from "../settings.json"

export interface GlobalState {
    appSettings?: any;
    settings?: typeof defaultSettings;
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
}

const initialState: GlobalState = {
    settings: defaultSettings,
    userInfo: {},
    appSettings: {},
    routes: [],
    userLoading: false,
    inited: false,
}

export default function store(state = initialState, action) {
    switch (action.type) {
        case "update-settings": {
            const {settings} = action.payload

            return {
                ...state,
                settings,
            }
        }
        case "update-userInfo": {
            const {userInfo = initialState.userInfo, userLoading} = action.payload
            return {
                ...state,
                userLoading,
                userInfo,
            }
        }
        case "update-breadcrumb": {
            const {breadcrumb} = action.payload
            return {
                ...state,
                breadcrumb,
            }
        }
        case "update-app-settings": {
            const {appSettings} = action.payload
            return {
                ...state,
                appSettings,
            }
        }
        case "update-routes": {
            const {routes} = action.payload
            return {
                ...state,
                routes,
            }
        }
        case "update-inited": {
            const {inited} = action.payload
            return {
                ...state,
                inited,
            }
        }
        default:
            return state
    }
}
