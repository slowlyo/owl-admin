import {useApp} from '@/hooks/useApp.ts'
import AmisRender from '@/components/AmisRender'

const LayoutTopBar = () => {
    const {getStore} = useApp()

    return (
        <div className="px-3">
            <AmisRender schema={getStore('userInfo.menus')}/>
        </div>
    )
}

export default LayoutTopBar
