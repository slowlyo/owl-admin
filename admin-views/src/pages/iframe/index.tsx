import React, {useMemo, useState, useEffect, useRef} from 'react'
import {Button, Result, Spin} from 'antd'
import {Token} from '@/utils/common'
import {useLang} from '@/hooks/useLang'

function IframePage({currentRoute}) {
    const {t} = useLang()
    const [loading, setLoading] = useState(true)
    const [loadError, setLoadError] = useState(false)
    const [height, setHeight] = useState('500px')
    const iframeRef = useRef<HTMLIFrameElement | null>(null)

    // 计算 iframe 可用高度，避免内容区域出现内部双滚动。
    const calculateHeight = () => {
        // @ts-ignore
        const topHeight = document.querySelector('.ant-layout-content.overflow-hidden')?.offsetTop || 65
        return `${window.innerHeight - topHeight}px`
    }

    const iframeUrl = useMemo(() => {
        const rawUrl = currentRoute?.iframe_url || ''

        // 没有 iframe 地址时直接返回空，由页面展示友好提示。
        if (!rawUrl) {
            return ''
        }

        // 外部地址不强行拼接查询参数，避免破坏第三方系统路由。
        if (/^https?:\/\//.test(rawUrl) && !rawUrl.startsWith(window.location.origin)) {
            return rawUrl
        }

        const url = new URL(rawUrl, window.location.origin)

        // 同源页面默认透传当前后台路由查询参数，便于详情页和筛选页复用 Blade 页面。
        new URLSearchParams(window.location.hash.split('?')[1] || '').forEach((value, key) => {
            if (!url.searchParams.has(key)) {
                url.searchParams.set(key, value)
            }
        })

        // iframe 原生请求不能附加 Authorization 头，同源页面通过一次 URL 参数交给后端中间件转换。
        if (!url.searchParams.has('_iframe_token') && Token().value) {
            url.searchParams.set('_iframe_token', Token().value)
        }

        return url.pathname + url.search + url.hash
    }, [currentRoute?.iframe_url, window.location.hash])

    const reloadIframe = () => {
        // 手动刷新时保留当前 query，并重新进入 loading 状态。
        if (iframeRef.current && iframeUrl) {
            setLoadError(false)
            setLoading(true)
            iframeRef.current.src = iframeUrl
        }
    }

    useEffect(() => {
        // 切换路由时重置加载状态，避免旧页面的完成态影响新页面。
        setLoading(Boolean(iframeUrl))
        setLoadError(false)

        // 空地址不写入 iframe，避免浏览器加载 about:blank 后误判为成功。
        if (iframeRef.current && iframeUrl) {
            iframeRef.current.src = iframeUrl
        }

        // 监听窗口大小变化，动态更新 iframe 高度。
        const handleResize = () => {
            setHeight(calculateHeight())
        }
        window.addEventListener('resize', handleResize)
        handleResize()

        return () => {
            window.removeEventListener('resize', handleResize)
        }
    }, [iframeUrl])

    useEffect(() => {
        const handleMessage = (event: MessageEvent) => {
            // 只接收同源页面发出的高度消息，避免外部 iframe 干扰后台页面。
            if (event.origin !== window.location.origin) {
                return
            }

            if (event.data?.type !== 'owl:iframe-height') {
                return
            }

            const nextHeight = Number(event.data.height)

            // 非法高度直接忽略，保留当前可用高度。
            if (!Number.isFinite(nextHeight) || nextHeight <= 0) {
                return
            }

            setHeight(`${Math.max(nextHeight, parseInt(calculateHeight()))}px`)
        }

        window.addEventListener('message', handleMessage)

        return () => window.removeEventListener('message', handleMessage)
    }, [])

    const handleIframeLoad = () => {
        setLoading(false)
    }

    const handleIframeError = () => {
        setLoading(false)
        setLoadError(true)
    }

    if (!iframeUrl) {
        return <Result status="warning" title={t('iframe.empty_url')}/>
    }

    if (loadError) {
        return (
            <Result
                status="error"
                title={t('iframe.load_failed')}
                subTitle={iframeUrl}
                extra={<Button onClick={reloadIframe}>{t('iframe.reload')}</Button>}
            />
        )
    }

    return (
        <div className="bg-[var(--owl-body-bg)]">
            <Spin spinning={loading} style={{minHeight: loading ? '500px' : ''}}>
                <iframe
                    className="owl-iframe"
                    ref={iframeRef}
                    title="Iframe Page"
                    width="100%"
                    style={{
                        border: 'none',
                        order: 0,
                        boxSizing: 'border-box',
                        overflow: 'hidden',
                        background: 'var(--owl-body-bg)',
                        height,
                        minHeight: '500px',
                    }}
                    onLoad={handleIframeLoad}
                    onError={handleIframeError}
                ></iframe>
            </Spin>
        </div>
    )
}

export default IframePage
