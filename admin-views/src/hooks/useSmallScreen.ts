import {useEffect, useState} from 'react'

// 监听视口断点并实时返回当前是否为小屏幕
const useSmallScreen = () => {
    const [isSmallScreen, setIsSmallScreen] = useState(
        () => window.matchMedia('(max-width: 767px)').matches
    )

    useEffect(() => {
        const mediaQuery = window.matchMedia('(max-width: 767px)')

        // 视口跨越断点时同步布局模式
        const handleChange = (event: MediaQueryListEvent) => {
            setIsSmallScreen(event.matches)
        }

        mediaQuery.addEventListener('change', handleChange)

        // 组件卸载时移除监听，避免重复订阅
        return () => mediaQuery.removeEventListener('change', handleChange)
    }, [])

    return isSmallScreen
}

export default useSmallScreen
