import './style/global.less'
import React from 'react'
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
    const {getAntdLocale, antdToken} = useSetup(store)

    const [lang, setLang] = useStorage('arco-lang', 'zh-CN')

    const contextValue = {lang, setLang}

    return (
        <HashRouter>
            <ConfigProvider theme={antdToken} wave={{disabled: true}} locale={getAntdLocale()}>
                <Provider store={store}>
                    <AliveScope>
                        <GlobalContext.Provider value={contextValue}>
                            <Switch>
                                <Route path="/login" component={Login}/>
                                {/*<Route path="/" component={PageLayout}/>*/}
                                <Route path="/" component={Layout}/>
                            </Switch>
                        </GlobalContext.Provider>
                    </AliveScope>
                </Provider>
            </ConfigProvider>
        </HashRouter>
    )
}

ReactDOM.render(<Index/>, document.getElementById('root'))
