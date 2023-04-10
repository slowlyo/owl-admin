import {useEffect} from "react"
import useLocale from "@/utils/useLocale"
import locale from "./locale"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import SimpleLogin from "./template/simple"
import DefaultLogin from "./template/default"
import AmisLogin from "./template/amis"

const Login = () => {
    const t = useLocale(locale)
    const {settings, inited, appSettings} = useSelector((state: GlobalState) => state)
    const loginTemplate = settings.loginTemplate || "default"

    useEffect(() => {
        if (window.location.hash === "#/login") {
            let title = t["login.form.login"]
            const titleTmp = appSettings.layout?.title
            if(titleTmp){
                title = titleTmp.replace(/%title%/g, title)
            }
            document.title = title
        }
    })

    const template = {
        default: DefaultLogin,
        simple: SimpleLogin,
        amis: AmisLogin
    }

    return inited && template[loginTemplate]()
}

export default Login
