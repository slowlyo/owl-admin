import React from "react"
import LoginForm from "@/pages/login/form"
import styles from "./style/index.module.less"
import {Card} from "@arco-design/web-react"

const SimpleLogin = () => {
    return (
        <div className={styles.container}>
            <div className={styles.content}>
                <div className={styles["content-inner"]}>
                    <Card className="p-15px shadow-sm">
                        <LoginForm/>
                    </Card>
                </div>
            </div>
        </div>
    )
}

export default SimpleLogin
