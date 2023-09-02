import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import {ConfigProvider} from 'antd'
import 'dayjs/locale/zh-cn'
import dayjs from 'dayjs'
import {Layout} from './layouts'
import {useApp} from '@/hooks/useApp.ts'
import {useTheme} from '@/hooks/useTheme.ts'
import {useMount} from 'ahooks'
import {Provider, useStore} from 'react-redux'
import {createStore} from 'redux'
import rootReducer from '@/store'
import {HashRouter, Route, Routes} from 'react-router-dom'
import {Login} from '@/pages/login'
import {useAuth} from '@/hooks/useAuth.ts'
import {registerGlobalFunctions} from '@/utils/common.ts'

dayjs.locale('zh-cn')

const store = createStore(rootReducer)

const App = () => {
    const app = useApp()
    const {getThemeConfig} = useTheme()

    const auth = useAuth(store)

    registerGlobalFunctions({
        afterLoginSuccess: auth.afterLoginSuccess,
        getToken: () => auth.token,
        logout: () => auth.logout(),
        checkLogin: () => auth.checkLogin(),
    })

    useMount(() => app.init(store))

    return (
        <HashRouter>
            <ConfigProvider theme={getThemeConfig()} locale={app.getAntdLocale()}>
                <Provider store={store}>
                    <Routes>
                        <Route path="/login" element={<Login/>}/>
                        <Route path="/" element={<Layout/>}/>
                    </Routes>
                </Provider>
            </ConfigProvider>
        </HashRouter>
    )
}

ReactDOM.createRoot(document.getElementById('root')!).render(<App/>)
