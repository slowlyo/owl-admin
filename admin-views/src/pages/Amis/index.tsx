import 'amis/lib/themes/cxd.css'
import 'amis/lib/helper.css'
import 'amis/sdk/iconfont.css'
import './index.less'
import '@fortawesome/fontawesome-free/css/all.css'
import {useLocation, history} from '@umijs/max'
import {render as renderAmis} from 'amis'
import {adminService} from "@/services/admin"
import {useEffect, useState} from 'react'
import axios from "axios"
import copy from 'copy-to-clipboard'
import {message} from 'antd'
import {PageContainer} from "@ant-design/pro-components"

export default () => {
    const location = useLocation()
    const [schema, setSchema] = useState<any>({})
    const [loading, setLoading] = useState(true)

    const initPage = () => {
        adminService.initPage(location.pathname).then((res) => {
            setSchema(res.data)
            setLoading(false)
        })
    }

    useEffect(() => {
        initPage()
    }, [])


    return (
        <PageContainer loading={loading} header={{title: ''}} className="animate__animated animate__fadeIn">
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
                    jumpTo: (location: string, action, ctx) => {
                        if (action?.blank) {
                            window.open(location)
                        } else {
                            history.push(location.startsWith('/') ? location : '/' + location)
                        }
                    }
                })
            }
        </PageContainer>
    )
}
