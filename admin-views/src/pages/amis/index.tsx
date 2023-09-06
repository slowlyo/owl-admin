import React, {useEffect, useState} from 'react'
import {useRequest} from 'ahooks'
import {history} from 'umi'
import {registerGlobalFunction} from '@/utils/common'
import {fetchPageSchema} from '@/services'
import AmisRender from '@/components/AmisRender'


const AmisPage = () => {
    const pathname = history.location.pathname

    const [schema, setSchema] = useState({})

    const initPage = useRequest(fetchPageSchema, {
        manual: true,
        loadingDelay: 300,
        cacheKey: pathname + '-schema',
        onSuccess(res: IRes) {
            // 先清空一次, 让数据也重新加载
            // setSchema({})
            setSchema(res.data)
            console.log(res.data)
        }
    })

    registerGlobalFunction('refreshAmisPage', () => initPage.runAsync(pathname))

    useEffect(() => initPage.run(pathname), [pathname])

    return (
        <>
            <AmisRender schema={schema}/>
        </>
    )
}

export default AmisPage
