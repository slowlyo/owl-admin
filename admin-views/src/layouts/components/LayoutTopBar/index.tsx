import AmisRender from '@/components/AmisRender'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'

const LayoutTopBar = () => {
    const {userInfo} = useSelector((state: GlobalState) => state)

    return (
        <div className="px-3">
            <AmisRender schema={userInfo?.menus}/>
        </div>
    )
}

export default LayoutTopBar
