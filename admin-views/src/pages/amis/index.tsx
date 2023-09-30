import React, {useState} from 'react'
import {useMount, useRequest} from 'ahooks'
import {initPageSchema} from '@/service/api'
import {useHistory} from 'react-router-dom'
import AmisRender from '@/components/AmisRender'
import {Spin} from 'antd'
import {registerGlobalFunction} from '@/utils/common'


function AmisPage() {
    const history = useHistory()
    const pathname = history.location.pathname

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
            <Spin spinning={initPage.loading}
                  className="w-full"
                  style={{minHeight: initPage.loading ? "500px" : ""}}>
                <AmisRender schema={schema}/>
            </Spin>
            <div className="h-20px"></div>
        </>
    )
}

export default AmisPage
