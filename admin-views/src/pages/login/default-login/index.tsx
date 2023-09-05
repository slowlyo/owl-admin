import React, {useEffect, useRef, useState} from 'react'
import Bg from './bg'
import {Button, Card, Checkbox, Form, FormInstance, Image, Input, Space, Spin} from 'antd'
// import {useSettings} from '@/hooks/useSettings.ts'
import {Icon} from '@iconify/react'
// import {useLang} from '@/hooks/useLang.ts'
import {useRequest} from 'ahooks'
import {useModel} from '@@/plugin-model'
// import {fetchCaptcha, fetchLogin} from '@/service'
// import {useAuth} from '@/hooks/useAuth.ts'

const DefaultLogin = () => {
    const formRef = useRef<FormInstance>()
    const {getSetting} = useModel('settingModel')
    // const auth = useAuth()
    // const {getSetting, get} = useSettings()
    // const settings = get()
    // const {t} = useLang()

    const t = (key) => {
        return key
    }

    const [error, setError] = useState('')
    const [sysCaptcha, setSysCaptcha] = useState('')
    const [captcha, setCaptcha] = useState(null)
    const [loading, setLoading] = useState(false)

    // const getCaptcha = useRequest(fetchCaptcha, {
    //     manual: true,
    //     throttleWait: 1000,
    //     onSuccess(res) {
    //         setSysCaptcha(res.data.sys_captcha)
    //         setCaptcha(res.data.captcha_img)
    //     }
    // })
    //
    // const doLogin = useRequest(fetchLogin, {
    //     manual: true,
    //     debounceWait: 500,
    //     onBefore() {
    //         setError('')
    //         setLoading(true)
    //     },
    //     onSuccess(res, params: any) {
    //         const {status, data} = res
    //         if (status === 0) {
    //             params = params[0]
    //
    //             const _data = params.remember ? {username: params.username, password: params.password} : {}
    //             window.$owl.afterLoginSuccess(_data, data.token)
    //         } else {
    //             setLoading(false)
    //             getCaptcha.run()
    //             setError(res.data.msg || t['login.form.login.errMsg'])
    //             formRef.current.setFieldsValue({captcha: ''})
    //         }
    //     },
    // })

    const submit = (values) => {
        setLoading(true)
        // if (settings.login_captcha) {
        //     Object.assign(values, {sys_captcha: sysCaptcha})
        // }
        // doLogin.run(values)
    }

    // useEffect(() => {
    //     if (settings.login_captcha) {
    //         // getCaptcha.run()
    //     }
    // }, [settings.login_captcha])

    // useEffect(() => {
    //     if (!!auth.loginParams) {
    //         const parseParams = JSON.parse(decodeURIComponent(window.atob(auth.loginParams)))
    //         formRef.current.setFieldsValue(parseParams)
    //     }
    //     formRef.current.setFieldsValue({remember: !!auth.loginParams})
    // }, [auth.loginParams])

    return (
        <Bg>
            <Card className="p-15px shadow-sm">
                <div className="w-[320px] p-2">
                    <div className="flex justify-between">
                        <Image src={getSetting('logo')} width={42} preview={false}/>
                        <div className="text-2xl font-normal">
                            {getSetting('app_name')}
                        </div>
                    </div>

                    <div className="h-[32px] flex items-center text-red-500 overflow-hidden">{error}</div>

                    <Form ref={formRef} initialValues={{remember: true}} onFinish={submit}>
                        <Form.Item name="username" rules={[{required: true, message: t('login.username_required')}]}>
                            <Input placeholder={t('login.username')} prefix={<Icon icon="ant-design:user-outlined"/>}/>
                        </Form.Item>

                        <Form.Item name="password" rules={[{required: true, message: t('login.password_required')}]}>
                            <Input.Password placeholder={t('login.password')}
                                            prefix={<Icon icon="ant-design:key-outlined"/>}/>
                        </Form.Item>

                        <Space>
                            <Form.Item name="captcha" rules={[{required: true, message: t('login.captcha_required')}]}>
                                <Input name="captcha"
                                       placeholder={t('login.captcha')}
                                       prefix={<Icon icon="ant-design:edit-twotone"/>}/>
                            </Form.Item>
                            <Form.Item>
                                {/*<Spin spinning={getCaptcha.loading}>*/}
                                {/*    <Image className="border rounded cursor-pointer"*/}
                                {/*           src={captcha}*/}
                                {/*           preview={false}*/}
                                {/*           onClick={() => getCaptcha.run()}*/}
                                {/*           width={100}*/}
                                {/*           height={32}/>*/}
                                {/*</Spin>*/}
                            </Form.Item>
                        </Space>

                        <Form.Item name="remember" valuePropName="checked">
                            <Checkbox> {t('login.remember_me')} </Checkbox>
                        </Form.Item>

                        <Button loading={loading} className="w-full" type="primary" htmlType="submit">
                            {t('login.title')}
                        </Button>
                    </Form>
                </div>
            </Card>
        </Bg>
    )
}

export default DefaultLogin
