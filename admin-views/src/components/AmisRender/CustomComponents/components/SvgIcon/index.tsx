import React, {forwardRef} from "react"
import {Icon} from "@iconify/react"

const SvgIcon = forwardRef((props: any, ref) => <Icon icon={props.icon} className={props.className}/>)

export default SvgIcon
