import React from "react"
import "./style/index.less"
import {render as renderAmis} from "amis"
import {GlobalState} from "@/store"
import {useSelector} from "react-redux"
import {amisRequest} from "@/service/api"
import {ToastComponent} from "amis-ui"
import {useHistory} from "react-router"

const AmisRender = ({schema}) => {
    const history = useHistory()
    const {appSettings} = useSelector(({appSettings}: GlobalState) => ({appSettings}))

    const props = {
        locale: appSettings.locale == "en" ? "en-US" : appSettings.locale
    }

    const options = {
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
