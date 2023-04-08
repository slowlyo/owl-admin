import {Button, Checkbox, Form, Image, Input, Space, Spin,} from "@arco-design/web-react"
import {FormInstance} from "@arco-design/web-react/es/Form"
import {IconLock, IconPen, IconUser} from "@arco-design/web-react/icon"
import React, {useEffect, useRef, useState} from "react"
import useStorage from "@/utils/useStorage"
import useLocale from "@/utils/useLocale"
import locale from "./locale"
import {useSelector, useDispatch} from "react-redux"
import {GlobalState} from "@/store"
import styles from "./style/index.module.less"
import {useRequest} from "ahooks"
import {fetchCaptcha, fetchLogin, fetchUserInfo} from "@/service/api"
import {setToken} from "@/utils/checkLogin"
import registerGlobalFunction from "@/utils/registerGlobalFunction"
import useRoute from "@/routes"

export default function LoginForm({onlyFunc}: { onlyFunc?: boolean }) {
    const dispatch = useDispatch()
    const formRef = useRef<FormInstance>()
    const [errorMessage, setErrorMessage] = useState("")
    const [loading, setLoading] = useState(false)
    const [sysCaptcha, setSysCaptcha] = useState("")
    const [captcha, setCaptcha] = useState("")
    const [loginParams, setLoginParams, removeLoginParams] = useStorage("loginParams")

    const t = useLocale(locale)

    const [rememberPassword, setRememberPassword] = useState(!!loginParams)
    const {appSettings} = useSelector((state: GlobalState) => state)
    const [_, defaultRoute] = useRoute()

    const initUserInfo = useRequest(fetchUserInfo, {
        manual: true,
        onSuccess(res) {
            dispatch({
                type: "update-userInfo",
                payload: {userInfo: res.data, userLoading: false},
            })
        }
    })

    function afterLoginSuccess(params, token) {
        // 记住密码
        if (params?.username && params?.password) {
            setLoginParams(JSON.stringify(params))
        } else {
            removeLoginParams()
        }
        // 记录登录状态
        setToken(token)
        // 获取用户信息
        initUserInfo.runAsync().then(() => {
            // 跳转首页
            window.location.hash = "#/" + defaultRoute
        })
    }

    registerGlobalFunction("afterLoginSuccess", afterLoginSuccess)

    const doLogin = useRequest(fetchLogin, {
        manual: true,
        debounceWait: 500,
        onBefore() {
            setErrorMessage("")
            setLoading(true)
        },
        onSuccess(res, params: any) {
            const {status, data} = res
            if (status === 0) {
                params = params[0]

                const _data = rememberPassword ? {username: params.username, password: params.password} : {}
                afterLoginSuccess(_data, data.token)
            } else {
                setLoading(false)
                getCaptcha.run()
                setErrorMessage(res.data.msg || t["login.form.login.errMsg"])
                formRef.current.setFieldsValue({captcha: ""})
            }
        },
    })

    function onSubmitClick() {
        formRef.current.validate().then((values) => {
            setLoading(true)
            if (appSettings.login_captcha) {
                Object.assign(values, {sys_captcha: sysCaptcha})
            }
            doLogin.run(values)
        })
    }

    const getCaptcha = useRequest(fetchCaptcha, {
        manual: true,
        throttleWait: 1000,
        onSuccess(res) {
            setSysCaptcha(res.data.sys_captcha)
            setCaptcha(res.data.captcha_img)
        }
    })

    // 读取 localStorage，设置初始值
    useEffect(() => {
        const rememberPassword = !!loginParams
        setRememberPassword(rememberPassword)
        if (formRef.current && rememberPassword) {
            const parseParams = JSON.parse(loginParams)
            formRef.current.setFieldsValue(parseParams)
        }

        if (appSettings.login_captcha){
            getCaptcha.run()
        }
    }, [loginParams])

    if (onlyFunc) return null

    return (
        <div className={styles["login-form-wrapper"]}>
            <div className="flex justify-between">
                <Image src={appSettings.logo} width={40}/>
                <div className={styles["login-form-title"]}>{appSettings.app_name}</div>
            </div>

            <div className={styles["login-form-error-msg"]}>{errorMessage}</div>

            <Form className={styles["login-form"]} layout="vertical" ref={formRef}>
                <Form.Item field="username" rules={[{required: true, message: t["login.form.userName.errMsg"]}]}>
                    <Input
                        prefix={<IconUser/>}
                        placeholder={t["login.form.userName.placeholder"]}
                        onPressEnter={onSubmitClick}
                    />
                </Form.Item>

                <Form.Item field="password" rules={[{required: true, message: t["login.form.password.errMsg"]}]}>
                    <Input.Password
                        prefix={<IconLock/>}
                        placeholder={t["login.form.password.placeholder"]}
                        onPressEnter={onSubmitClick}
                    />
                </Form.Item>

                {appSettings.login_captcha && (
                    <Form.Item field="captcha" rules={[{required: true, message: t["login.form.captcha.errMsg"]}]}>
                        <Input
                            className="captcha-input"
                            prefix={<IconPen/>}
                            placeholder={t["login.form.captcha.placeholder"]}
                            addAfter={
                                <Spin loading={getCaptcha.loading}>
                                    <Image src={captcha}
                                           height="30"
                                           preview={false}
                                           className="cursor-pointer"
                                           onClick={() => getCaptcha.run()}/>
                                </Spin>
                            }
                            onPressEnter={onSubmitClick}
                        />
                    </Form.Item>
                )}

                <Space size={16} direction="vertical">
                    <div className={styles["login-form-password-actions"]}>
                        <Checkbox checked={rememberPassword} onChange={setRememberPassword}>
                            {t["login.form.rememberPassword"]}
                        </Checkbox>
                    </div>
                    <Button type="primary" long onClick={onSubmitClick} loading={loading}>
                        {t["login.form.login"]}
                    </Button>
                </Space>
            </Form>
        </div>
    )
}
