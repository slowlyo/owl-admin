import React, {useState, useEffect, useRef} from 'react'
import {Spin} from 'antd'

function IframePage({currentRoute}) {
    const [loading, setLoading] = useState(true)
    const iframeRef = useRef(null) // 使用 ref 来引用 iframe，以便进行操作
    // 计算 iframe 高度
    const calculateHeight = () => {
        // @ts-ignore
        const topHeight = document.querySelector('.ant-layout-content.overflow-hidden')?.offsetTop || 65
        return `${window.innerHeight - topHeight}px`
    }

    const updateIframeSrc = () => {
        // 使用 currentRoute.iframe_url 作为键来检查缓存中是否有此 iframe
        iframeRef.current.src = currentRoute.iframe_url
    }

    useEffect(() => {
        // 当路由改变时更新 iframe 源
        updateIframeSrc()
        // 监听窗口大小变化，动态更新 iframe 高度
        const handleResize = () => {
            iframeRef.current.style.height = calculateHeight()
        }
        window.addEventListener('resize', handleResize)
        // 设置初始高度
        handleResize()

        return () => {
            window.removeEventListener('resize', handleResize)
        }
    }, [currentRoute.iframe_url])

    // iframe 加载完毕时的处理
    const handleIframeLoad = () => {
        setLoading(false)
    }

    return (
        <>
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
                        minHeight: '500px', // 设置最小高度以保持加载状态时的布局
                    }}
                    onLoad={handleIframeLoad}
                ></iframe>
            </Spin>
        </>
    )
}

export default IframePage
