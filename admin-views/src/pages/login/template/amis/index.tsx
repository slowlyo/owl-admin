import React from "react"
import AmisPage from "@/pages/amis"
import LoginForm from "@/pages/login/form"

const AmisLogin = () => {
    return (
        <>
            <LoginForm onlyFunc/>
            <AmisPage/>
        </>
    )
}

export default AmisLogin
