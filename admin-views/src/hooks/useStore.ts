import {useSelector, useDispatch} from 'react-redux'

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
