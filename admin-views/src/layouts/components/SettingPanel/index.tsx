import {Button, ColorPicker, Drawer, Form, Select} from 'antd'
import useStore from '@/hooks/useStore'
import {useLang} from '@/hooks/useLang'

const SettingPanel = () => {
    const {state, dispatch} = useStore()
    const {t} = useLang()

    const closeSetting = () => {
        dispatch({
            type: 'update-open-setting',
            payload: {openSetting: false}
        })
    }

    const handleChange = (e) => {
        console.log(e)
    }

    return (
        <Drawer open={state.openSetting}
                onClose={closeSetting}
                closeIcon={false}
                title={t('theme_setting.title')}
                footer={(
                    <Button type="primary">保存</Button>
                )}>
            <Form
                labelAlign="left"
                labelCol={{span: 8}}
                wrapperCol={{span: 16}}
            >
                <Form.Item colon={false} label={t('theme_setting.theme_color')}>
                    <ColorPicker showText disabledAlpha presets={[
                        {
                            label: t('theme_setting.preinstall'),
                            colors: ['#F5222D', '#FA8C16', '#FADB14', '#8BBB11', '#52C41A', '#13A8A8', '#1677FF', '#2F54EB', '#722ED1', '#EB2F96'],
                        },
                    ]}/>
                </Form.Item>
                <Form.Item colon={false} label={t('theme_setting.layout_mode')}>
                    <Select
                        style={{width: '100%'}}
                        defaultValue="default"
                        onChange={handleChange}
                        options={[
                            {value: 'default', label: t('theme_setting.layout_mode_default')},
                            {value: 'top', label: t('theme_setting.layout_mode_top')},
                            {value: 'top-mix', label: t('theme_setting.layout_mode_top_mix')},
                            {value: 'double', label: t('theme_setting.layout_mode_double')},
                        ]}
                    />
                </Form.Item>
            </Form>
        </Drawer>
    )
}
export default SettingPanel
