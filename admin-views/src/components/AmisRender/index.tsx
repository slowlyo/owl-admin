import React, {useCallback, useMemo} from 'react'
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

    const localeValue = useMemo(
        () => localeMap[getSetting('locale') || 'zh_CN'] || 'zh-CN',
        [getSetting]
    )

    const props = useMemo(() => ({locale: localeValue, location: history.location}), [localeValue, history.location])

    const fetcher = useCallback(async ({url, method, data}) => {
        const res = await amisRequest(url, method, data)
        return wrapAxiosLikeIfAmbiguous(toAxiosLike(res))
    }, [])

    const updateLocation = useCallback(
        (location, replace) => {
            replace || history.push(location)
        },
        [history]
    )

    const jumpTo = useCallback(
        (location: string) => {
            if (location.startsWith('http') || location.startsWith('https')) {
                window.open(location)
            } else {
                history.push(location.startsWith('/') ? location : `/${location}`)
            }
        },
        [history]
    )

    const copy = useCallback(async (content) => {
        await clipboard(content)
        toast.success(localeValue === 'zh-CN' ? '复制成功' : 'Copy success')
    }, [localeValue])

    const isCurrentUrl = useCallback(
        (url: string) => history.location.pathname + history.location.search === url,
        [history.location.pathname, history.location.search]
    )

    const options: RenderOptions = useMemo(() => ({
        enableAMISDebug: getSetting('show_development_tools'),
        fetcher,
        updateLocation,
        jumpTo,
        copy,
        isCurrentUrl,
    }), [getSetting, fetcher, updateLocation, jumpTo, copy, isCurrentUrl])

    if (!schema) return null

    return (
        <div className={className}>
            {renderAmis(schema, props, options)}
        </div>
    )
}

export default AmisRender
