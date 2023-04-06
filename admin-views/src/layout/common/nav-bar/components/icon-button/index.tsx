import React, {forwardRef} from "react"
import {Button} from "@arco-design/web-react"
import styles from "./style/icon-button.module.less"
import cs from "classnames"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"

function IconButton(props, ref) {
    const {icon, className, ...rest} = props
    const {settings} = useSelector((state: GlobalState) => state)

    return (
        <Button
            ref={ref}
            icon={icon}
            shape="circle"
            type="secondary"
            className={cs(styles["icon-button"], className)}
            style={{
                color: settings.topTheme === "dark" ? "var(--color-text-4)" : "",
                backgroundColor: settings.topTheme === "dark" ? "rgba(var(--gray-1), 0.2)" : ""
            }}
            {...rest}
        />
    )
}

export default forwardRef(IconButton)
