import {Badge, Button, ColorPicker, Drawer, Form, message, Radio, Space} from 'antd'
import useStore from '@/hooks/useStore'
import {useLang} from '@/hooks/useLang'
import SelectLayout from '@/layouts/components/SettingPanel/components/SelectLayout'
import useTheme from '@/hooks/useTheme'
import useSetting from '@/hooks/useSetting'
import {useHistory} from 'react-router-dom'
import {appLoaded, getCacheKey} from '@/utils/common'
import {useRequest} from 'ahooks'
import {saveSettings} from '@/service/api'
import {useState} from 'react'

const SettingPanel = () => {
    const history = useHistory()
    const pathname = history.location.pathname
    const {state, dispatch} = useStore()
    const {setThemeColor} = useTheme()
    const {settings} = useSetting()
    const {t} = useLang()

    const [cachedSettings, setCachedSettings] = useState(localStorage.getItem(getCacheKey('settings')))

    const closeSetting = () => {
        dispatch({
            type: 'update-open-setting',
            payload: {openSetting: false}
        })
    }

    const handleChange = (key, value) => {
        if (key === 'themeColor') setThemeColor(value)

        const system_theme_setting = Object.assign({}, settings.system_theme_setting, {[key]: value})
        console.log(system_theme_setting)
        dispatch({
            type: 'update-settings',
            payload: {settings: {...settings, system_theme_setting}}
        })

        if (key === 'layoutMode') {
            // 解决刷新后页面不显示的问题
            window.$owl.appLoader()
            history.push('/')
            setTimeout(() => {
                history.push(pathname)
                setTimeout(() => {
                    appLoaded()
                }, 500)
            }, 200)
        }
    }

    const save = useRequest(saveSettings, {
        manual: true,
        onSuccess: () => {
            message.success(t('theme_setting.save_success'))

            // 保存成功后，更新缓存
            localStorage.setItem(getCacheKey('settings'), JSON.stringify(settings))
            setCachedSettings(JSON.stringify(settings))
        }
    })

    const submit = () => {
        save.run({system_theme_setting: settings.system_theme_setting})
    }

    return (
        <Drawer open={state.openSetting}
                onClose={closeSetting}
                closeIcon={false}
                title={t('theme_setting.title')}
                footer={(
                    <>
                        <Space>
                            <Badge dot
                                   count={cachedSettings != JSON.stringify(state.settings) ? 1 : 0}
                                   title={t('theme_setting.need_save')}>
                                <Button type="primary"
                                        onClick={submit}
                                        disabled={save.loading}>{t('theme_setting.save_btn')}</Button>
                            </Badge>
                            <Button onClick={closeSetting}
                                    disabled={save.loading}>{t('theme_setting.cancel_btn')}</Button>

                        </Space>
                    </>
                )}>
            <Form labelAlign="left" labelCol={{span: 8}} wrapperCol={{span: 16}}>
                {/*主题色*/}
                <Form.Item colon={false} label={t('theme_setting.theme_color')}>
                    <ColorPicker showText
                                 disabledAlpha
                                 onChange={(_, hex) => handleChange('themeColor', hex)}
                                 presets={[{
                                     label: t('theme_setting.preinstall'),
                                     colors: ['#1677FF', '#F5222D', '#FA8C16', '#52C41A', '#13A8A8', '#2F54EB', '#722ED1', '#EB2F96'],
                                 }]}/>
                </Form.Item>

                {/*布局模式*/}
                <Form.Item colon={false} label={t('theme_setting.layout_mode')}>
                    <SelectLayout current={settings.system_theme_setting.layoutMode}
                                  change={(value) => handleChange('layoutMode', value)}/>
                </Form.Item>

                {/*登录页模板*/}
                <Form.Item colon={false} label={t('theme_setting.login_template')}>
                    <Radio.Group
                        onChange={(e) => handleChange('loginTemplate', e.target.value)}
                        value={settings.system_theme_setting.loginTemplate}
                        optionType="button"
                        options={[
                            {label: t('theme_setting.default'), value: 'default'},
                            {label: 'amis', value: 'amis'}
                        ]}/>
                </Form.Item>

                {/*顶部菜单主题*/}
                <Form.Item colon={false} label={t('theme_setting.top_theme')}>
                    <Radio.Group
                        onChange={(e) => handleChange('topTheme', e.target.value)}
                        value={settings.system_theme_setting.topTheme}
                        optionType="button"
                        options={[
                            {label: t('theme_setting.light'), value: 'light'},
                            {label: t('theme_setting.dark'), value: 'dark'}
                        ]}/>
                </Form.Item>

                {/*侧边栏主题*/}
                <Form.Item colon={false} label={t('theme_setting.sider_theme')}>
                    <Radio.Group
                        onChange={(e) => handleChange('siderTheme', e.target.value)}
                        value={settings.system_theme_setting.siderTheme}
                        optionType="button"
                        options={[
                            {label: t('theme_setting.light'), value: 'light'},
                            {label: t('theme_setting.dark'), value: 'dark'}
                        ]}/>
                </Form.Item>
            </Form>
        </Drawer>
    )
}
export default SettingPanel
