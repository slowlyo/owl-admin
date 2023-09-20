import './style/global.less'
import React, {useState} from 'react'
import ReactDOM from 'react-dom'
import {createStore} from 'redux'
import {Provider} from 'react-redux'
import {HashRouter, Route, Switch} from 'react-router-dom'
import rootReducer from './store'
import {GlobalContext} from './context'
import Login from './pages/login'
import useStorage from './utils/useStorage'
import {AliveScope} from 'react-activation'
import Layout from '@/layouts'
import {ConfigProvider} from 'antd'
import useSetup from '@/hooks/useSetup'

const store = createStore(rootReducer)

function Index() {
    const {getAntdLocale} = useSetup(store)
    const [lang, setLang] = useStorage('arco-lang', 'zh-CN')
    const [antdToken, setAntdToken] = useState(store.getState().antdToken)

    const contextValue = {lang, setLang, antdToken, setAntdToken}

    return (
        <HashRouter>
            <Provider store={store}>
                <ConfigProvider theme={antdToken} wave={{disabled: true}} locale={getAntdLocale()}>
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

ReactDOM.render(<Index/>, document.getElementById('root'))
