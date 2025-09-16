import React from 'react'
import './style/index.less'
import {render as renderAmis, RenderOptions} from 'amis'
import {toast} from 'amis-ui'
import {amisRequest} from '@/service/api'
import {useHistory} from 'react-router'
import clipboard from '@/utils/clipboard'
import useSetting from '@/hooks/useSetting'
import { toAxiosLike, wrapAxiosLikeIfAmbiguous } from '@/utils/amisAdaptor'

const AmisRender = ({schema, className = ''}) => {
    const history = useHistory()
    const {getSetting} = useSetting()

    const localeMap = {
        'zh_CN': 'zh-CN',
        'en': 'en-US'
    }

    const localeValue = localeMap[getSetting('locale') || 'zh_CN'] || 'zh-CN'

    const props = {locale: localeValue, location: history.location}

    const options: RenderOptions = {
        enableAMISDebug: getSetting('show_development_tools'),
        fetcher: async ({url, method, data}) => {
            const res = await amisRequest(url, method, data)
            return wrapAxiosLikeIfAmbiguous(toAxiosLike(res))
        },
        updateLocation: (location, replace) => {
            replace || history.push(location)
        },
        jumpTo: (location: string) => {
            if (location.startsWith('http') || location.startsWith('https')) {
                window.open(location)
            } else {
                history.push(location.startsWith('/') ? location : `/${location}`)
            }
        },
        copy: async (content) => {
            await clipboard(content)

            toast.success(props.locale === 'zh-CN' ? '复制成功' : 'Copy success')
        },
        isCurrentUrl: (url: string) => history.location.pathname + history.location.search === url,
    }

    if (!schema) return null

    return (
        <div className={className}>
            {renderAmis(schema, props, options)}
        </div>
    )
}

export default AmisRender
