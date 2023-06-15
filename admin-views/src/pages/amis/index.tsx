import React, {useState} from "react"
import {useMount, useRequest} from "ahooks"
import {initPageSchema} from "@/service/api"
import {useHistory} from "react-router-dom"
import AmisRender from "@/components/AmisRender"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import Footer from "@/layout/common/footer"
import registerGlobalFunction from "@/utils/registerGlobalFunction"
import {Spin} from "@arco-design/web-react"


function AmisPage() {
    const history = useHistory()
    const pathname = history.location.pathname
    const {settings} = useSelector((state: GlobalState) => state)

    const [schema, setSchema] = useState({})

    const initPage = useRequest(initPageSchema, {
        manual: true,
        loadingDelay: 300,
        cacheKey: pathname + "-schema",
        onSuccess(res) {
            // 先清空一次, 让数据也重新加载
            setSchema({})
            setSchema(res.data)
        }
    })

    registerGlobalFunction("refreshAmisPage", () => initPage.runAsync(pathname))

    useMount(() => initPage.run(pathname))

    return (
        <>
            <Spin loading={initPage.loading}
                  dot
                  size={8}
                  className="w-full"
                  style={{minHeight: initPage.loading ? "500px" : ""}}>
                <AmisRender schema={schema}/>
            </Spin>
            {(settings.footer && !initPage.loading) && <Footer/>}
            <div className="h-20px"></div>
        </>
    )
}

export default AmisPage
