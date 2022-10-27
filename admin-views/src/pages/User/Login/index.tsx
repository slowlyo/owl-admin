import {
    LockOutlined,
    UserOutlined,
} from '@ant-design/icons'
import {
    LoginForm,
    ProFormCheckbox,
    ProFormText,
} from '@ant-design/pro-components'
import {FormattedMessage, history, useIntl, useModel} from '@umijs/max'
import {Alert, message} from 'antd'
import React, {useState} from 'react'
import {flushSync} from 'react-dom'
import styles from './index.less'

import {adminService} from '@/services/admin'
import {setToken} from "@/utils/user"

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

    const handleSubmit = async (values: API.LoginParams) => {
        try {
            const result: any = await adminService.login(values)

            if (result.status == 1) {
                // 如果失败去设置用户错误信息
                setErrorMessage(result.msg)
                return
            }

            setToken(result.data.token, values.autoLogin)

            message.success(result.msg)

            await fetchUserInfo()

            const urlParams = new URL(window.location.href).searchParams

            history.push(urlParams.get('redirect') || '/')
        } catch (error) {
            console.log(error)
            message.error('登录失败，请重试！')
        }
    }

    return (
        <div className={styles.container}>
            <div className={styles.content}>
                <LoginForm
                    logo={<img alt="logo" src="/logo.svg"/>}
                    title="Slow Admin"
                    subTitle=" "
                    initialValues={{
                        autoLogin: true,
                    }}
                    actions={[]}
                    onFinish={async (values) => {
                        await handleSubmit(values as API.LoginParams)
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
            {/*这个你可能需要*/}
            {/*<Footer/>*/}
        </div>
    )
}

export default Login
