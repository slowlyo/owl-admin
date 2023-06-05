import React from "react"
import "./style/index.less"
import {render as renderAmis, RenderOptions} from "amis"
import {Message} from "@arco-design/web-react"
import {GlobalState} from "@/store"
import {useSelector} from "react-redux"
import {amisRequest} from "@/service/api"
import {ToastComponent} from "amis-ui"
import {useHistory} from "react-router"
import clipboard from "@/utils/clipboard"

const AmisRender = ({schema}) => {
    const history = useHistory()
    const {appSettings} = useSelector(({appSettings}: GlobalState) => ({appSettings}))

    const localeMap = {
        "zh_CN": "zh-CN",
        "en": "en-US"
    }

    const props = {
        locale: localeMap[appSettings?.locale || "zh_CN"] || "zh-CN",
    }

    const options: RenderOptions = {
        enableAMISDebug: appSettings.show_development_tools,
        fetcher: ({url, method, data}) => amisRequest(url, method, data),
        // eslint-disable-next-line @typescript-eslint/no-empty-function
        updateLocation: () => {
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

            Message.success(props.locale === "zh-CN" ? "复制成功" : "Copy success")
        },
    }

    return (
        <div>
            <ToastComponent key="toast"></ToastComponent>
            {renderAmis(schema, props, options)}
        </div>
    )
}

export default AmisRender
