import useLocale from "@/utils/useLocale"
import locale from "./locale"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import SimpleLogin from "./template/simple"
import DefaultLogin from "./template/default"
import AmisLogin from "./template/amis"
import {useMount} from "ahooks"
import {inLoginPage} from '@/utils/common'

const Login = () => {
    const t = useLocale(locale)
    const {settings, appSettings} = useSelector((state: GlobalState) => state)
    const loginTemplate = settings.loginTemplate || "default"

    useMount(() => {
        if (inLoginPage()) {
            // 页面标题
            let title = t["login.form.login"]
            const titleTmp = appSettings.layout?.title
            if (titleTmp) {
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

    return template[loginTemplate]()
}

export default Login
