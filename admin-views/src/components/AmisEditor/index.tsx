import React from "react"
import {Editor} from "amis-editor"
import {amisRequest} from "@/service/api"
import {useNavigate} from 'react-router'
import clipboard from "@/utils/clipboard"
import "amis-editor-core/lib/style.css"
import "./style/index.css"
import {useSettings} from '@/hooks/useSettings.ts'
import {message} from 'antd'

function AmisEditor({onChange, preview}) {
    const [schema, setSchema] = React.useState({} as any)
    const navigate = useNavigate()
    const settings = useSettings().get()

    const change = (val) => {
        onChange(val)
    }

    const env = {
        enableAMISDebug: settings.show_development_tools,
        fetcher: ({url, method, data}) => amisRequest(url, method, data),
        updateLocation: (location, replace) => {
            replace || navigate(location)
        },
        jumpTo: (location: string) => {
            if (location.startsWith("http") || location.startsWith("https")) {
                window.open(location)
            } else {
                navigate(location.startsWith("/") ? location : `/${location}`)
            }
        },
        copy: async (content) => {
            await clipboard(content)

            message.success("复制成功")
        },
        notify: (type: "error" | "success", msg: string) => {
            message[type] ? message[type](msg) : console.warn("[Notify]", type, msg)
        }
    }

    return (
        <div className="h-full">
            <Editor theme="cxd" onChange={change} value={schema} preview={preview} amisEnv={env}/>
        </div>
    )
}

export default AmisEditor
