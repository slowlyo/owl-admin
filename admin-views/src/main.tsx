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
import {ConfigProvider} from 'antd'
import useSetup from '@/hooks/useSetup'

const store = createStore(rootReducer)

function Admin() {
    const {getAntdLocale} = useSetup(store)
    const [antdToken, setAntdToken] = useState(store.getState().antdToken)
    const contextValue = {antdToken, setAntdToken}

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

ReactDOM.render(<Admin/>, document.getElementById('root'))
