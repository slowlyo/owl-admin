import {arrayGet} from '@/utils/common'
import {useSelector, useDispatch} from 'react-redux'
import {GlobalState} from '@/store'

const useStore = () => {
    const state: any = useSelector((state: GlobalState) => state)
    const dispatch = useDispatch()

    return {
        state,
        dispatch
    }
}

export default useStore
