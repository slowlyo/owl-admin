import 'amis/lib/themes/cxd.css'
import 'amis/lib/helper.css'
import 'amis/sdk/iconfont.css'
import './index.less'
import '@fortawesome/fontawesome-free/css/all.min.css'
import {useLocation} from '@umijs/max'
import {render as renderAmis} from 'amis'
import {adminService} from "@/services/admin"
import {useEffect, useState} from 'react'
import axios from "axios"
import copy from 'copy-to-clipboard'
import {message} from 'antd'

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
                    fetcher: ({url, method, data}) => {
                        return adminService.request(url, method, data)
                    },
                    updateLocation: () => {
                    },
                    isCancel: (value: any) => (axios as any).isCancel(value),
                    copy: content => {
                        copy(content as any)
                        message.success('内容已复制到粘贴板').then()
                    },
                })
            }
        </>
    )
}
