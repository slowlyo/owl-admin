import React from "react"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import Layout from "./layouts"
import {getToken} from "@/utils/checkLogin"

export const PageLayout = () => {
    const {inited, settings} = useSelector((state: GlobalState) => state)

    return (inited && getToken()) && <Layout mode={settings.layoutMode}/>
}
