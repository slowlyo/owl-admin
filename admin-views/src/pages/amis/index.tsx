import React, {useEffect, useState} from "react"
import {useRequest} from "ahooks"
import {initPageSchema} from "@/service/api"
import {useHistory} from "react-router-dom"
import AmisRender from "@/components/AmisRender"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import Footer from "@/layout/common/footer"
import registerGlobalFunction from "@/utils/registerGlobalFunction"


function AmisPage() {
    const history = useHistory()
    const pathname = history.location.pathname
    const {settings} = useSelector((state: GlobalState) => state)

    const [schema, setSchema] = useState("")

    const initPage = useRequest(initPageSchema, {
        manual: true,
        cacheKey: pathname + "-schema",
        onSuccess(res) {
            // 先清空一次, 让数据也重新加载
            setSchema("")
            setSchema(res.data)
        }
    })

    registerGlobalFunction("refreshAmisPage", () => initPage.runAsync(pathname))

    useEffect(() => initPage.run(pathname), [])

    return (
        <>
            <AmisRender schema={schema}/>
            {settings.footer && <Footer/>}
        </>
    )
}

export default AmisPage
