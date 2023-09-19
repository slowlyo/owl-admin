import './style/global.less'
import React, {useEffect, useMemo} from 'react'
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
import useTheme from '@/hooks/useTheme'

const store = createStore(rootReducer)

function Index() {
    const {getAntdLocale} = useSetup(store)
    const {antdToken} = useTheme(store)

    const [lang, setLang] = useStorage('arco-lang', 'zh-CN')

    const contextValue = {lang, setLang}

    return (
        <HashRouter>
            <Provider store={store}>
                <ConfigProvider theme={{...antdToken}} wave={{disabled: true}} locale={getAntdLocale()}>
                    <AliveScope>
                        <GlobalContext.Provider value={contextValue}>
                            <Switch>
                                <Route path="/login" component={Login}/>
                                {/*<Route path="/" component={PageLayout}/>*/}
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
