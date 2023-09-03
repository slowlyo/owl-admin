import React from 'react'
import {createRoot} from 'react-dom/client'
import './index.css'
import {App, ConfigProvider} from 'antd'
import 'dayjs/locale/zh-cn'
import dayjs from 'dayjs'
import {useApp} from '@/hooks/useApp.ts'
import {useTheme} from '@/hooks/useTheme.ts'
import {useMount} from 'ahooks'
import {Provider} from 'react-redux'
import {createStore} from 'redux'
import rootReducer from '@/store'
import {HashRouter, Route, Switch} from 'react-router-dom'
import {useAuth} from '@/hooks/useAuth.ts'
import {registerGlobalFunctions} from '@/utils/common.ts'
import {Login} from '@/pages/login'
import {Layout} from '@/layouts'
import {GlobalContext} from '@/components/GlobalContext'

dayjs.locale('zh-cn')

const store = createStore(rootReducer)

const Root = () => {
    const app = useApp()
    const auth = useAuth()
    const {getThemeConfig} = useTheme()

    registerGlobalFunctions({
        afterLoginSuccess: auth.afterLoginSuccess,
        getToken: () => auth.token,
        logout: () => auth.logout(),
        checkLogin: () => auth.checkLogin(),
    })

    useMount(() => app.init())

    return (
        <HashRouter>
            <ConfigProvider theme={getThemeConfig()} locale={app.getAntdLocale()}>
                <App className="h-full w-full">
                    <Provider store={store}>
                        <Switch>
                            <Route path="/login" component={Login}/>
                            <Route path="/" component={Layout}/>
                        </Switch>
                    </Provider>
                </App>
            </ConfigProvider>
        </HashRouter>
    )
}

createRoot(document.getElementById('root')!).render(
    <GlobalContext.Provider value={{store}}>
        <Root/>
    </GlobalContext.Provider>
)
