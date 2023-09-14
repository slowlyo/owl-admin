import AmisRender from '@/components/AmisRender'
import {useSelector} from 'react-redux'
import {GlobalState} from '@/store'
import RefreshButton from '@/layouts/components/LayoutTopBar/components/RefreshButton'
import FullscreenButton from '@/layouts/components/LayoutTopBar/components/FullscreenButton'
import SettingButton from '@/layouts/components/LayoutTopBar/components/SettingButton'
import {Button, Popover} from 'antd'
import {Icon} from '@iconify/react'

const LayoutTopBar = ({collapsed = false}) => {
    const {userInfo} = useSelector((state: GlobalState) => state)

    const actions = [
        <RefreshButton/>,
        <FullscreenButton/>,
        <SettingButton/>
    ]

    return (
        <div className="h-full flex justify-around items-center">
            {collapsed ? (
                <Popover placement="bottom" content={actions} trigger="click">
                    <Button type="text" block>
                        <Icon icon="material-symbols:arrow-drop-down-circle-outline" fontSize={18}/>
                    </Button>
                </Popover>
            ) : actions}
            <div className="bg-transparent h-full pr-6 cursor-pointer hover:bg-gray-100 transition duartion-300">
                <AmisRender className="h-full" schema={userInfo?.menus}/>
            </div>
        </div>
    )
}

export default LayoutTopBar
