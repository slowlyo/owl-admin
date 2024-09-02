import {Icon} from '@iconify/react'
import IconButton from '@/layouts/components/IconButton'

// 折叠切换按钮
const CollapseTrigger = ({collapsed, toggle}) => {
    return (
        <IconButton onClick={() => toggle(!collapsed)}>
            <div className="p-1 h-full flex justify-center items-center">
                {collapsed && <Icon icon="ant-design:menu-unfold-outlined" fontSize={18}/>}
                {collapsed || <Icon icon="ant-design:menu-fold-outlined" fontSize={18}/>}
            </div>
        </IconButton>
    )
}

export default CollapseTrigger
