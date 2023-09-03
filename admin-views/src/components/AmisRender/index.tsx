import React from 'react'
import 'amis/lib/themes/cxd.css'
import 'amis/lib/helper.css'
import 'amis/sdk/iconfont.css'
import '@fortawesome/fontawesome-free/css/all.css'
import './style/index.css'
import {render as renderAmis, RenderOptions} from 'amis'
import {amisRequest} from '@/service/api'
import {ToastComponent} from 'amis-ui'
import clipboard from '@/utils/clipboard'
import {useHistory} from 'react-router-dom'
import {message} from 'antd'
import {useSettings} from '@/hooks/useSettings.ts'

const AmisRender = ({schema}) => {
    const history = useHistory()
    const settings = useSettings().get()

    const localeMap = {
        "zh_CN": "zh-CN",
        "en": "en-US"
    }

    const props = {
        locale: localeMap[settings?.locale || "zh_CN"] || "zh-CN",
        location: location,
    } as any

    const options: RenderOptions = {
        enableAMISDebug: settings.show_development_tools,
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

    return (
        <div>
            <ToastComponent key="toast"></ToastComponent>
            {renderAmis(schema, props, options)}
        </div>
    )
}

export default AmisRender
