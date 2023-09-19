import {arrayGet} from '@/utils/common'
import {useSelector, useDispatch} from 'react-redux'
import {GlobalState} from '@/store'

const useStore = () => {
    const state: any = useSelector((state: GlobalState) => state)
    const dispatch = useDispatch()
    const getState = () => state

    return {
        state,
        getState,
        dispatch
    }
}

export default useStore
