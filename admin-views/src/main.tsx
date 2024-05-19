import './global.css'
import React, {useState} from 'react'
import ReactDOM from 'react-dom'
import {createStore} from 'redux'
import {Provider} from 'react-redux'
import {HashRouter, Route, Switch} from 'react-router-dom'
import rootReducer from './store'
import {GlobalContext} from './context'
import Login from './pages/login'
import {AliveScope} from 'react-activation'
import Layout from '@/layouts'
import {ConfigProvider, theme} from 'antd'
import useSetup from '@/hooks/useSetup'
import useTheme from '@/hooks/useTheme'

// 创建 store
const store = createStore(rootReducer)

const Admin = () => {
    // 获取 antd 的国际化配置
    const {getAntdLocale} = useSetup(store)

    // antd 的主题配置
    const [antdToken, setAntdToken] = useState(store.getState().antdToken)

    // 主题配置
    useTheme(store)

    // antdToken 放入上下文
    const contextValue = {antdToken, setAntdToken}

    return (
        <HashRouter>
            <Provider store={store}>
                <ConfigProvider
                    wave={{disabled: true}}
                    locale={getAntdLocale()}
                    theme={{
                        ...antdToken,
                        algorithm: store.getState().settings.system_theme_setting.darkTheme ? theme.darkAlgorithm : theme.defaultAlgorithm,
                        cssVar: {key: 'owl'}
                    }}>
                    <AliveScope>
                        <GlobalContext.Provider value={contextValue}>
                            <Switch>
                                <Route path="/login" component={Login}/>
                                <Route path="/" component={Layout}/>
                            </Switch>
                        </GlobalContext.Provider>
                    </AliveScope>
                </ConfigProvider>
            </Provider>
        </HashRouter>
    )
}

ReactDOM.render(<Admin/>, document.getElementById('root'))
