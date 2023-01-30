import {ProFormText} from "@ant-design/pro-components";
import {adminService} from "@/services/admin";
import {useEffect, useState} from "react";
import {FormattedMessage, useIntl} from "@umijs/max";

import styles from './index.less'

export const LoginCaptcha = (props: any) => {
    const [captcha, setCaptcha] = useState<string>('')

    const intl = useIntl()

    const reloadCaptcha = () => {
        adminService.captcha().then((res) => {
            setCaptcha(res.data.captcha_img)

            props.form.setFieldValue('sys_captcha', res.data.sys_captcha)
        })
    }

    useEffect(() => {
        reloadCaptcha()
    }, [])

    return (
        <div>
            <ProFormText name="sys_captcha" hidden/>
            <div className={styles.box}>
                <ProFormText
                    name="captcha"
                    fieldProps={{
                        size: 'large',
                    }}
                    placeholder={intl.formatMessage({
                        id: 'pages.login.captcha.placeholder',
                        defaultMessage: '请输入验证码',
                    })}
                    rules={[
                        {
                            required: true,
                            message: (
                                <FormattedMessage
                                    id="pages.login.captcha.required"
                                    defaultMessage="请输入验证码!"
                                />
                            ),
                        },
                    ]}
                />
                <div className={styles.captchaImage}>
                    <img src={captcha} onClick={() => reloadCaptcha()} alt='' />
                </div>
            </div>
        </div>
    );
}
