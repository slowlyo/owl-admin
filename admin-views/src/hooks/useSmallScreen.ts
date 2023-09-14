import {useSize} from 'ahooks'

const useSmallScreen = () => {
    return useSize(document.body)?.width < 768
}

export default useSmallScreen
