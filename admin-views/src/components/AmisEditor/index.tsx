import React from "react"
import {Editor} from "amis-editor"
import {GlobalState} from "@/store"
import {useSelector} from "react-redux"
import {amisRequest} from "@/service/api"
import {useHistory} from "react-router"
import clipboard from "@/utils/clipboard"
import {Message} from "@arco-design/web-react"
import "amis-editor-core/lib/style.css"
import "./style/index.less"
import useSetting from '@/hooks/useSetting'

function AmisEditor({onChange, preview}) {
    const [schema, setSchema] = React.useState({} as any)
    const {getSetting} = useSetting()
    const history = useHistory()

    const change = (val) => {
        onChange(val)
    }

    const env = {
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

            Message.success("复制成功")
        },
        notify: (type: "error" | "success", msg: string) => {
            Message[type] ? Message[type](msg) : console.warn("[Notify]", type, msg)
        }
    }

    return (
        <div className="h-full">
            <Editor theme="cxd" onChange={change} value={schema} preview={preview} amisEnv={env}/>
        </div>
    )
}

export default AmisEditor
