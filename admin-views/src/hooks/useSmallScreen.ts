import {useSize} from 'ahooks'

export const useSmallScreen = () => {
    return useSize(document.body)?.width < 768
}
