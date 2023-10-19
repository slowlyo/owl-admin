import React from 'react'
import './style/index.less'
import {render as renderAmis, RenderOptions} from 'amis'
import {message} from 'antd'
import {amisRequest} from '@/service/api'
import {useHistory} from 'react-router'
import clipboard from '@/utils/clipboard'
import useSetting from '@/hooks/useSetting'

const AmisRender = ({schema, className = ''}) => {
    const history = useHistory()
    const {getSetting} = useSetting()

    const localeMap = {
        'zh_CN': 'zh-CN',
        'en': 'en-US'
    }

    const props = {
        locale: localeMap[getSetting('locale') || 'zh_CN'] || 'zh-CN',
        location: history.location,
    }

    const options: RenderOptions = {
        enableAMISDebug: getSetting('show_development_tools'),
        fetcher: ({url, method, data}) => amisRequest(url, method, data),
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

            message.success(props.locale === 'zh-CN' ? '复制成功' : 'Copy success')
        },
        notify: (type: string, msg: string, conf) => {
            const msgKey = 'msg-' + msg
            localStorage.setItem(msgKey, msg)

            message.open({
                key: 'owl-message',
                content: msg,
                type: (['info', 'success', 'error', 'warning', 'loading'].includes(type) ? type : 'info') as any,
                duration: (conf?.timeout || 3000) / 1000,
            }).then(() => {
                localStorage.removeItem(msgKey)
            })
        }
    }

    return (
        <div className={className}>
            {renderAmis(schema, props, options)}
        </div>
    )
}

export default AmisRender
