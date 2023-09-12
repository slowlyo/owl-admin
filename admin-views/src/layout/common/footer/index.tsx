import React from "react"
import {Layout} from "@arco-design/web-react"
import {FooterProps} from "@arco-design/web-react/es/Layout/interface"
import cs from "classnames"
import styles from "./style/index.module.less"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"

function Footer(props: FooterProps = {}) {
    const {className, ...restProps} = props
    const {appSettings} = useSelector((state: GlobalState) => state)

    return (
        <Layout.Footer className={cs(styles.footer, className)} {...restProps}>
            <div dangerouslySetInnerHTML={{__html: appSettings?.layout?.footer}}></div>
        </Layout.Footer>
    )
}

export default Footer
