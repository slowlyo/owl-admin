import {Icon} from '@iconify/react'

const IconButton = ({onClick, icon = null, children = null, iconClassName = ''}) => {
    return (
        <div className="text-lg flex justify-center items-center h-full px-2 cursor-pointer hover:bg-gray-100 transition duartion-300"
             onClick={onClick}>
            {children ? children : <Icon className={iconClassName} icon={icon} fontSize={20}/>}
        </div>
    )
}
export default IconButton
