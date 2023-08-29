import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import {ConfigProvider} from 'antd'
import zhCN from 'antd/locale/zh_CN'
import 'dayjs/locale/zh-cn'
import dayjs from 'dayjs'
import {appLoaded} from './utils/common.ts'
import {Layout} from './layout'

dayjs.locale('zh-cn')

const App = () => {

    appLoaded()

    return (
        <ConfigProvider locale={zhCN}>
            <Layout/>
        </ConfigProvider>
    )
}

ReactDOM.createRoot(document.getElementById('root')!).render(
    <React.StrictMode>
        <App/>
    </React.StrictMode>,
)
