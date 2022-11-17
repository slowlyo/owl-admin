import {
    LockOutlined,
    UserOutlined,
} from '@ant-design/icons'
import {
    LoginForm,
    ProFormCheckbox,
    ProFormText,
} from '@ant-design/pro-components'
import {FormattedMessage, useIntl, useModel} from '@umijs/max'
import {Alert, message} from 'antd'
import React, {forwardRef, useState} from 'react'
import {flushSync} from 'react-dom'
import styles from './index.less'

import {adminService} from '@/services/admin'
import {setToken} from "@/utils/user"
import {getSettingItem} from "@/utils/setting"
import RcQueueAnim from "rc-queue-anim"

const LoginMessage: React.FC<{
    content: string;
}> = ({content}) => {
    return (
        <Alert
            style={{
                marginBottom: 24,
            }}
            message={content}
            type="error"
            showIcon
        />
    )
}

const Login: React.FC = () => {
    const [errorMessage, setErrorMessage] = useState<string>('')
    const {initialState, setInitialState} = useModel('@@initialState')

    const intl = useIntl()

    const fetchUserInfo = async () => {
        const userInfo = await initialState?.fetchUserInfo?.()

        if (userInfo) {
            flushSync(() => {
                setInitialState((s) => ({
                    ...s,
                    currentUser: userInfo,
                }))
            })
        }
    }

    const handleSubmit = async (values: any) => {
        try {
            const result: any = await adminService.login(values)

            if (result.status == 1) {
                // 如果失败去设置用户错误信息
                setErrorMessage(result.msg)
                return
            }

            setToken(result.data.token, values.autoLogin)

            await fetchUserInfo()

            // @ts-ignore 更新路由数据
            window.location.href = window.slowAdminConfig.loginSuccessRedirect
        } catch (error) {
            console.log(error)
            message.error('登录失败，请重试！')
        }
    }

    const logoPath = getSettingItem('logo')
    const appName = getSettingItem('app_name')

    return (
        <div className={styles.content}>
            <LoginForm
                logo={<img alt="logo" src={logoPath}/>}
                title={appName}
                subTitle=" "
                initialValues={{
                    autoLogin: true,
                }}
                actions={[]}
                onFinish={async (values) => {
                    await handleSubmit(values)
                }}
            >
                {errorMessage && (
                    <LoginMessage content={errorMessage}/>
                )}
                <ProFormText
                    name="username"
                    fieldProps={{
                        size: 'large',
                        prefix: <UserOutlined className={styles.prefixIcon}/>,
                    }}
                    placeholder={intl.formatMessage({
                        id: 'pages.login.username.placeholder',
                        defaultMessage: '请输入用户名',
                    })}
                    rules={[
                        {
                            required: true,
                            message: (
                                <FormattedMessage
                                    id="pages.login.username.required"
                                    defaultMessage="请输入用户名!"
                                />
                            ),
                        },
                    ]}
                />
                <ProFormText.Password
                    name="password"
                    fieldProps={{
                        size: 'large',
                        prefix: <LockOutlined className={styles.prefixIcon}/>,
                    }}
                    placeholder={intl.formatMessage({
                        id: 'pages.login.password.placeholder',
                        defaultMessage: '请输入密码',
                    })}
                    rules={[
                        {
                            required: true,
                            message: (
                                <FormattedMessage
                                    id="pages.login.password.required"
                                    defaultMessage="请输入密码！"
                                />
                            ),
                        },
                    ]}
                />

                <div style={{marginBottom: 24}}>
                    <ProFormCheckbox noStyle name="autoLogin">
                        <FormattedMessage id="pages.login.rememberMe" defaultMessage="记住我"/>
                    </ProFormCheckbox>
                </div>
            </LoginForm>
        </div>
        // {/*这个你可能需要*/}
        // {/*<Footer/>*/}
    )
}

// export default Login
export default forwardRef((props, ref) => {
    return (
        <div className={styles.container} style={{
            // @ts-ignore
            backgroundImage: `url(${window.slowAdminConfig.loginBackground})`
        }}>
            {/*alpha left right top bottom scale scaleBig scaleX scaleY*/}
            <RcQueueAnim ref={ref} duration={650} type="top">
                <div key={location.pathname}>
                    <Login/>
                </div>
            </RcQueueAnim>
        </div>
    )
})
