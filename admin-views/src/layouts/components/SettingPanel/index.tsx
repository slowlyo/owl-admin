import {Alert, Button, ColorPicker, Drawer, Form, Space} from 'antd'
import useStore from '@/hooks/useStore'
import {useLang} from '@/hooks/useLang'
import SelectLayout from '@/layouts/components/SettingPanel/components/SelectLayout'
import useTheme from '@/hooks/useTheme'
import useSetting from '@/hooks/useSetting'
import {useHistory} from 'react-router-dom'
import {appLoaded, getCacheKey} from '@/utils/common'

const SettingPanel = () => {
    const history = useHistory()
    const pathname = history.location.pathname
    const {state, dispatch} = useStore()
    const {setThemeColor} = useTheme()
    const {settings} = useSetting()
    const {t} = useLang()
    const cachedSettings = localStorage.getItem(getCacheKey('settings'))

    const closeSetting = () => {
        dispatch({
            type: 'update-open-setting',
            payload: {openSetting: false}
        })
    }

    const handleChange = (key, value) => {
        if (key === 'themeColor') setThemeColor(value)

        const system_theme_setting = Object.assign({}, settings.system_theme_setting, {[key]: value})
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

    const save = () => {
        // localStorage.setItem(getCacheKey('settings'), JSON.stringify(res.data))
    }

    return (
        <Drawer open={state.openSetting}
                onClose={closeSetting}
                closeIcon={false}
                title={t('theme_setting.title')}
                footer={(
                    <Space>
                        <Button type="primary">{t('theme_setting.save_btn')}</Button>
                        <Button onClick={closeSetting}>{t('theme_setting.cancel_btn')}</Button>
                    </Space>
                )}>
            {cachedSettings != JSON.stringify(state.settings) && (
                <Alert className="mb-3" message={t('theme_setting.need_save')} showIcon type="warning"/>
            )}
            <Form
                labelAlign="left"
                labelCol={{span: 8}}
                wrapperCol={{span: 16}}
            >
                <Form.Item colon={false} label={t('theme_setting.theme_color')}>
                    <ColorPicker showText
                                 disabledAlpha
                                 onChange={(_, hex) => handleChange('themeColor', hex)}
                                 presets={[
                                     {
                                         label: t('theme_setting.preinstall'),
                                         colors: ['#1677FF', '#F5222D', '#FA8C16', '#52C41A', '#13A8A8', '#2F54EB', '#722ED1', '#EB2F96'],
                                     },
                                 ]}/>
                </Form.Item>

                <Form.Item colon={false} label={t('theme_setting.layout_mode')}>
                    <SelectLayout current={settings.system_theme_setting.layoutMode}
                                  change={(value) => handleChange('layoutMode', value)}/>
                </Form.Item>
            </Form>
        </Drawer>
    )
}
export default SettingPanel
