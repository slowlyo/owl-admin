import {Icon} from '@iconify/react'

export const CollapseTrigger = ({collapsed, toggle}) => {
    return (
        <div className="border-r border-t hover:text-blue-500 text-lg flex justify-center items-center h-full"
             onClick={() => toggle(!collapsed)}>
            {collapsed && <Icon icon="line-md:menu-fold-right"/>}
            {collapsed || <Icon icon="line-md:menu-fold-left"/>}
        </div>
    )
}
