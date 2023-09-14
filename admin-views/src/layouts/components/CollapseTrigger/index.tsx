import {Icon} from '@iconify/react'
import IconButton from '@/layouts/components/IconButton'

const CollapseTrigger = ({collapsed, toggle}) => {
    return (
        <IconButton onClick={() => toggle(!collapsed)}>
            <div className="p-1 h-full flex justify-center items-center">
                {collapsed && <Icon icon="line-md:menu-fold-right" fontSize={18}/>}
                {collapsed || <Icon icon="line-md:menu-fold-left" fontSize={18}/>}
            </div>
        </IconButton>
    )
}

export default CollapseTrigger
