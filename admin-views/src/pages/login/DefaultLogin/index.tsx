import React, {useEffect, useRef, useState} from 'react'
import Bg from './bg'
import {Button, Card, Checkbox, Form, FormInstance, Image, Input, Space, Spin} from 'antd'
import {Icon} from '@iconify/react'
import {useRequest} from 'ahooks'
import {fetchCaptcha, fetchLogin} from '@/service/api'
import useSetting from '@/hooks/useSetting'
import useStorage from '@/utils/useStorage'
import {getCacheKey} from '@/utils/common'
import {useLang} from '@/hooks/useLang'

const DefaultLogin = () => {
    const formRef = useRef<FormInstance>()
    const {getSetting, settings} = useSetting()
    const {t} = useLang()
    const [loginParams] = useStorage(getCacheKey("loginParams"))

    const [error, setError] = useState('')
    const [sysCaptcha, setSysCaptcha] = useState('')
    const [captcha, setCaptcha] = useState(null)
    const [loading, setLoading] = useState(false)

    const getCaptcha = useRequest(fetchCaptcha, {
        manual: true,
        throttleWait: 1000,
        onSuccess(res) {
            setSysCaptcha(res.data.sys_captcha)
            setCaptcha(res.data.captcha_img)
        }
    })

    const doLogin = useRequest(fetchLogin, {
        manual: true,
        debounceWait: 500,
        onBefore() {
            setError('')
            setLoading(true)
        },
        onSuccess(res, params: any) {
            const {status, data} = res
            if (status === 0) {
                params = params[0]

                const _data = params.remember ? {username: params.username, password: params.password} : {}
                window.$owl.afterLoginSuccess(_data, data.token)
            } else {
                setLoading(false)
                getCaptcha.run()
                setError(res.data.msg)
                formRef.current.setFieldsValue({captcha: ''})
            }
        },
    })

    const submit = (values) => {
        setLoading(true)
        if (settings.login_captcha) {
            Object.assign(values, {sys_captcha: sysCaptcha})
        }
        doLogin.run(values)
    }

    useEffect(() => {
        if (settings.login_captcha) {
            getCaptcha.run()
        }
    }, [settings.login_captcha])

    useEffect(() => {
        if (!!loginParams) {
            const parseParams = JSON.parse(decodeURIComponent(window.atob(loginParams)))
            formRef.current.setFieldsValue(parseParams)
        }
        formRef.current.setFieldsValue({remember: !!loginParams})
    }, [loginParams])

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

                        {settings.login_captcha && (
                            <Space>
                                <Form.Item name="captcha"
                                           rules={[{required: true, message: t('login.captcha_required')}]}>
                                    <Input name="captcha"
                                           placeholder={t('login.captcha')}
                                           prefix={<Icon icon="ant-design:edit-twotone"/>}/>
                                </Form.Item>
                                <Form.Item>
                                    <Spin spinning={getCaptcha.loading}>
                                        <Image className="border rounded cursor-pointer"
                                               src={captcha || ''}
                                               preview={false}
                                               onClick={() => getCaptcha.run()}
                                               width={100}
                                               height={32}/>
                                    </Spin>
                                </Form.Item>
                            </Space>
                        )}

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
