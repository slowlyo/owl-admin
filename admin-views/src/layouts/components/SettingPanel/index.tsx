import {Button, ColorPicker, Drawer, Form, Space} from 'antd'
import useStore from '@/hooks/useStore'
import {useLang} from '@/hooks/useLang'
import SelectLayout from '@/layouts/components/SettingPanel/components/SelectLayout'
import useTheme from '@/hooks/useTheme'

const SettingPanel = () => {
    const {state, dispatch} = useStore()
    const {setThemeColor} = useTheme()
    const {t} = useLang()

    const closeSetting = () => {
        dispatch({
            type: 'update-open-setting',
            payload: {openSetting: false}
        })
    }

    const handleChange = (key, value) => {
        if (key === 'themeColor') setThemeColor(value)

        const system_theme_setting = Object.assign({}, state.settings.system_theme_setting, {system_theme_setting: {[key]: value}})
        dispatch({
            type: 'update-settings',
            payload: {settings: {...state.settings, system_theme_setting}}
        })
    }

    return (
        <Drawer open={state.openSetting}
                onClose={closeSetting}
                closeIcon={false}
                title={t('theme_setting.title')}
                footer={(
                    <Space>
                        <Button type="primary">保存配置</Button>
                        <Button onClick={closeSetting}>取消</Button>
                    </Space>
                )}>
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
                    <SelectLayout current={'default'} change={(value) => handleChange('layoutMode', value)}/>
                </Form.Item>
            </Form>
        </Drawer>
    )
}
export default SettingPanel
