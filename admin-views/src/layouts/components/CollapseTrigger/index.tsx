import {Icon} from '@iconify/react'

const CollapseTrigger = ({collapsed, toggle}) => {
    return (
        <div className="text-lg flex justify-center items-center h-full p-3 cursor-pointer hover:bg-gray-100"
             onClick={() => toggle(!collapsed)}>
            {collapsed && <Icon icon="line-md:menu-fold-right"/>}
            {collapsed || <Icon icon="line-md:menu-fold-left"/>}
        </div>
    )
}

export default CollapseTrigger
