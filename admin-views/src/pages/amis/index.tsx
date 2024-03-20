import React, {useState} from 'react'
import {useMount, useRequest} from 'ahooks'
import {initPageSchema} from '@/service/api'
import {useHistory} from 'react-router-dom'
import AmisRender from '@/components/AmisRender'
import {Spin} from 'antd'
import {registerGlobalFunction} from '@/utils/common'

const cache = () => {
    return {
        get: (key: string) => {
            let _cache = sessionStorage.getItem(key)

            return _cache ? JSON.parse(_cache) : {}
        },
        set: (key: string, schema: any) => {
            sessionStorage.setItem(key, JSON.stringify(schema))
        }
    }
}

function AmisPage() {
    const history = useHistory()
    const pathname = history.location.pathname + history.location.search
    const cacheKey = pathname + '-schema'

    const [schema, setSchema] = useState(cache().get(cacheKey))

    const initPage = useRequest(initPageSchema, {
        cacheKey,
        manual: true,
        loadingDelay: 700,
        onSuccess(res) {
            if (JSON.stringify(res.data) != JSON.stringify(cache().get(cacheKey))) {
                setSchema(res.data)

                cache().set(cacheKey, res.data)
            }
        }
    })

    registerGlobalFunction('refreshAmisPage', () => initPage.runAsync(pathname))

    useMount(() => initPage.run(pathname))

    return (
        <>
            <Spin spinning={initPage.loading}
                  className="w-full"
                  style={{minHeight: initPage.loading ? '500px' : ''}}>
                <AmisRender schema={schema}/>
            </Spin>
            <div className="h-5"></div>
        </>
    )
}

export default AmisPage
