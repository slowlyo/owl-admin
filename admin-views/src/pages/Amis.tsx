import 'amis/lib/themes/cxd.css'
import 'amis/lib/helper.css'
import 'amis/sdk/iconfont.css'
import {useLocation} from '@umijs/max'
import {render as renderAmis} from 'amis'
import {adminService} from "@/services/admin"
import {useEffect, useState} from 'react'

export default () => {
    const location = useLocation()
    const [schema, setSchema] = useState<any>({})

    const initPage = () => {
        adminService.initPage(location.pathname).then((res) => {
            setSchema(res.data)
        })
    }

    useEffect(() => {
        initPage()
    }, [])


    return (
        <>
            {
                renderAmis(schema, {}, {
                    fetcher: ({
                                  url, // 接口地址
                                  method, // 请求方法 get、post、put、delete
                                  data, // 请求数据
                              }) => {
                        return adminService.request(url, method, data)
                    },
                    updateLocation: () => {
                    },
                })
            }
        </>
    )
}
