import React, {useState} from 'react'
import {useMount, useRequest} from 'ahooks'
import {initPageSchema} from '@/service/api'
import {useHistory} from 'react-router-dom'
import AmisRender from '@/components/AmisRender'
import {Spin} from 'antd'
import {registerGlobalFunction} from '@/utils/common'
import useRoute from '@/routes'

const cache = () => {
    return {
        get: (key: string) => {
            const _cache = sessionStorage.getItem(key)

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
    const {getCurrentRoute} = useRoute()
    const currentRoute = getCurrentRoute()
    const cacheKey = pathname + '-schema'

    const [schema, setSchema] = useState(cache().get(cacheKey))
    const [manual, setManual] = useState(false)

    const initPage = useRequest(initPageSchema, {
        cacheKey,
        manual: true,
        loadingDelay: 700,
        onSuccess(res) {
            if (manual) {
                setSchema({})
                setSchema(res.data)

                cache().set(cacheKey, res.data)

                return
            }

            if (JSON.stringify(res.data) != JSON.stringify(cache().get(cacheKey))) {
                setSchema(res.data)

                cache().set(cacheKey, res.data)
            }
        }
    })

    registerGlobalFunction('refreshAmisPage', () => {
        setManual(true)
        return initPage.runAsync(pathname, currentRoute?.page_sign)
    })

    useMount(() => initPage.run(pathname, currentRoute?.page_sign))

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
