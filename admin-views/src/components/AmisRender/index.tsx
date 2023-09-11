import React from 'react'
import 'amis/lib/themes/cxd.css';
import 'amis/lib/helper.css';
import 'amis/sdk/iconfont.css';
import '@fortawesome/fontawesome-free/css/all.css'
import "./style/index.css"
import {render as renderAmis, RenderOptions} from 'amis'
import {ToastComponent} from 'amis-ui'
import clipboard from '@/utils/clipboard'
import {message} from 'antd'
import {history} from 'umi'
import {useModel} from '@@/plugin-model'
import {amisRequest} from '@/services'

const AmisRender = ({schema}:{schema: any}) => {
    const {getSetting} = useModel('settingModel')

    const localeMap:any = {
        "zh_CN": "zh-CN",
        "en": "en-US"
    }

    const props = {
        locale: localeMap[getSetting('locale') || "zh_CN"] || "zh-CN",
        location: history.location,
    } as any

    const options: RenderOptions = {
        enableAMISDebug: getSetting('show_development_tools'),
        fetcher: ({url, method, data}) => amisRequest(url, method, data),
        updateLocation: (location, replace) => {
            replace || history.push(location)
        },
        jumpTo: (location: string) => {
            if (location.startsWith("http") || location.startsWith("https")) {
                window.open(location)
            } else {
                history.push(location.startsWith("/") ? location : `/${location}`)
            }
        },
        copy: async (content) => {
            await clipboard(content)

            message.success(props.locale === "zh-CN" ? "复制成功" : "Copy success")
        },
        notify: (type: "error" | "success", msg: string) => {
            message.destroy()
            message[type] ? message[type](msg) : console.warn("[Notify]", type, msg)
        }
    }

    if(JSON.stringify(schema) == '{}'){
        return null
    }

    // {renderAmis(schema, props, options)}
    return (
        <div>
            <ToastComponent key="toast"></ToastComponent>
            {renderAmis(schema, props, options)}
        </div>
    )
}

export default AmisRender
