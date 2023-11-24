import {useSize} from 'ahooks'

// 处理小屏幕
const useSmallScreen = () => {
    return useSize(document.body)?.width < 768
}

export default useSmallScreen
