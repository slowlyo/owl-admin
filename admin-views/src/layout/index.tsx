import React from "react"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import Layout from "./layouts"

export const PageLayout = () => {
    const {inited, settings} = useSelector((state: GlobalState) => state)

    return inited && <Layout mode={settings.layoutMode}/>
}
