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

const store = createStore(rootReducer)

const Admin = () => {
    const {getAntdLocale} = useSetup(store)
    const [antdToken, setAntdToken] = useState(store.getState().antdToken)
    useTheme(store)

    const contextValue = {antdToken, setAntdToken}

    return (
        <HashRouter>
            <Provider store={store}>
                <ConfigProvider
                    wave={{disabled: true}}
                    locale={getAntdLocale()}
                    theme={{
                        ...antdToken,
                        algorithm: store.getState().settings.system_theme_setting.darkTheme ? theme.darkAlgorithm : theme.defaultAlgorithm
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
