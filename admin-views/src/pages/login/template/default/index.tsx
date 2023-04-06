import React from "react"
import Bg from "./bg"
import LoginForm from "@/pages/login/form"
import {Card} from "@arco-design/web-react"

const DefaultLogin = () => {
    return (
        <Bg>
            <Card className="p-15px shadow-sm">
                <LoginForm/>
            </Card>
        </Bg>
    )
}

export default DefaultLogin