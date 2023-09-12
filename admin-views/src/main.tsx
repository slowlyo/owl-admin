import "virtual:uno.css"
import "./style/global.less"
import React from "react"
import ReactDOM from "react-dom"
import {createStore} from "redux"
import {Provider} from "react-redux"
import {ConfigProvider} from "@arco-design/web-react"
import zhCN from "@arco-design/web-react/es/locale/zh-CN"
import enUS from "@arco-design/web-react/es/locale/en-US"
import {HashRouter, Route, Switch} from "react-router-dom"
import rootReducer from "./store"
import {GlobalContext} from "./context"
import Login from "./pages/login"
import {checkLogin} from "./utils/checkLogin"
import useStorage from "./utils/useStorage"
import {PageLayout} from "@/layout"
import {fetchSettings, fetchUserInfo} from "@/service/api"
import {useMount, useRequest} from "ahooks"
import {setThemeColor} from "@/utils/themeColor"
import {dynamicAssetsHandler} from "@/utils/dynamicAssets"
import {AliveScope} from "react-activation"
import {registerCustomComponents} from "@/components/AmisRender/CustomComponents"

registerCustomComponents()

const store = createStore(rootReducer)

function Index() {
    const [lang, setLang] = useStorage("arco-lang", "zh-CN")

    function getArcoLocale() {
        switch (lang) {
            case "zh-CN":
                return zhCN
            case "en-US":
                return enUS
            default:
                return zhCN
        }
    }

    // 初始化配置信息
    const initSettings = useRequest(fetchSettings, {
        manual: true,
        retryCount: 3,
        cacheKey: "app-settings",
        onBefore() {
            store.dispatch({
                type: "update-userInfo",
                payload: {userLoading: true},
            })
        },
        onSuccess(res) {
            store.dispatch({
                type: "update-app-settings",
                payload: {appSettings: res.data},
            })
            if (res.data.system_theme_setting) {
                store.dispatch({
                    type: "update-settings",
                    payload: {settings: res.data.system_theme_setting},
                })
            }
            setLang(res.data.locale == "zh_CN" ? "zh-CN" : "en-US")
            setThemeColor(store.getState().settings.themeColor)
            dynamicAssetsHandler(res.data.assets)
        },
        onFinally() {
            store.dispatch({
                type: "update-inited",
                payload: {inited: true},
            })
        }
    })

    const initUserInfo = useRequest(fetchUserInfo, {
        manual: true,
        onSuccess(res) {
            store.dispatch({
                type: "update-userInfo",
                payload: {userInfo: res.data, userLoading: false},
            })
        }
    })

    useMount(() => {
        initSettings.run()
        setThemeColor(store.getState().settings.themeColor)

        if (checkLogin()) {
            initUserInfo.run()
        } else if (window.location.pathname.replace(/\//g, "") !== "login") {
            window.location.hash = "#/login"
        }
    })

    const contextValue = {lang, setLang}

    return (
        <HashRouter>
            <ConfigProvider locale={getArcoLocale()}>
                <Provider store={store}>
                    <AliveScope>
                        <GlobalContext.Provider value={contextValue}>
                            <Switch>
                                <Route path="/login" component={Login}/>
                                <Route path="/" component={PageLayout}/>
                            </Switch>
                        </GlobalContext.Provider>
                    </AliveScope>
                </Provider>
            </ConfigProvider>
        </HashRouter>
    )
}

ReactDOM.render(<Index/>, document.getElementById("root"))
