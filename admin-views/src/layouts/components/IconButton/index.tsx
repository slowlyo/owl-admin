import {Icon} from '@iconify/react'

// 图标按钮
const IconButton = ({onClick, icon = null, children = null, iconClassName = ''}) => {
    return (
        <div className="text-lg flex justify-center items-center h-full px-2 cursor-pointer"
             onClick={onClick}>
            {children ? children : <Icon className={iconClassName} icon={icon} fontSize={20}/>}
        </div>
    )
}
export default IconButton
