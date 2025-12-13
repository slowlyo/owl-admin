import {
    Badge,
    Button,
    Checkbox,
    ColorPicker,
    Drawer,
    Form,
    InputNumber,
    message,
    Radio,
    Select,
    Space,
    Switch,
} from 'antd'
import useStore from '@/hooks/useStore'
import {useLang} from '@/hooks/useLang'
import SelectLayout from '@/layouts/components/SettingPanel/components/SelectLayout'
import useTheme from '@/hooks/useTheme'
import useSetting from '@/hooks/useSetting'
import {getCacheKey} from '@/utils/common'
import {useRequest} from 'ahooks'
import {saveSettings} from '@/service/api'
import {useCallback, useMemo, useState} from 'react'

// 定义系统主题设置接口
interface SystemThemeSetting {
    themeColor: string;
    darkTheme: boolean;
    layoutMode: 'default' | 'top' | 'top-mix' | 'double';
    loginTemplate: 'default' | 'amis';
    topTheme: 'light' | 'dark';
    siderTheme: 'light' | 'dark';
    footer: boolean;
    breadcrumb: boolean;
    enableTab: boolean;
    tabIcon: boolean;
    animateInType: string;
    animateInDuration: number;
    animateOutType: string;
    animateOutDuration: number;
    keepAlive: boolean;
    accordionMenu: boolean;
    followSystemTheme?: boolean;
}

// 定义设置接口
interface Settings {
    system_theme_setting: SystemThemeSetting;
    [key: string]: any;
}

// 表单配置项接口
interface SettingItemProps {
    label: string;
    condition?: boolean;
    children: React.ReactNode;
}

/**
 * 设置项组件
 * 用于根据条件渲染表单项，优化条件渲染逻辑
 */
const SettingItem = ({ label, condition = true, children }: SettingItemProps) => {
    if (!condition) return null;
    
    return (
        <Form.Item colon={false} label={label}>
            {children}
        </Form.Item>
    );
};

/**
 * 设置面板组件
 * 用于管理系统的主题和布局设置
 */
const SettingPanel = () => {
    const {state, dispatch} = useStore();
    const {setThemeColor, setDarkTheme} = useTheme();
    const {settings} = useSetting();
    const {t} = useLang();

    const [cachedSettings, setCachedSettings] = useState<string | null>(localStorage.getItem(getCacheKey('settings')));

    // 检查是否有未保存的更改
    const hasUnsavedChanges = useMemo(() => {
        if (!cachedSettings) return false;
        
        try {
            const parsed = JSON.parse(cachedSettings);
            return JSON.stringify(parsed.system_theme_setting) !== JSON.stringify(settings.system_theme_setting);
        } catch (e) {
            return false;
        }
    }, [cachedSettings, settings]);

    // 关闭设置面板
    const closeSetting = useCallback(() => {
        dispatch({
            type: 'update-open-setting',
            payload: {openSetting: false}
        });
    }, [dispatch]);

    /**
     * 处理设置更改
     * @param key 要更改的设置键
     * @param value 新的设置值
     */
    const handleChange = useCallback((key: keyof SystemThemeSetting, value: any) => {
        if (key === 'themeColor') setThemeColor(value);
        if (key === 'darkTheme') setDarkTheme(value);

        const system_theme_setting = { 
            ...settings.system_theme_setting,
            [key]: value 
        };
        
        dispatch({
            type: 'update-settings',
            payload: {settings: {...settings, system_theme_setting}}
        });
    }, [dispatch, setThemeColor, setDarkTheme, settings]);

    // 保存设置API请求
    const save = useRequest(saveSettings, {
        manual: true,
        onSuccess: () => {
            message.success(t('theme_setting.save_success'));

            // 保存成功后，更新缓存
            const settingsToCache = JSON.stringify(settings);
            localStorage.setItem(getCacheKey('settings'), settingsToCache);
            setCachedSettings(settingsToCache);
        }
    });

    // 提交设置
    const submit = useCallback(() => {
        save.run({system_theme_setting: settings.system_theme_setting});
    }, [save, settings]);

    /**
     * 获取动画选项
     * @param type 动画类型 ('in' 或 'out')
     * @returns 动画选项数组
     */
    const getAnimateOptions = useCallback((type: string) => {
        const animateOptions = ['alpha', 'left', 'right', 'top', 'bottom', 'scale', 'scaleBig', 'scaleX', 'scaleY'];

        return animateOptions.map((item) => ({
            label: t(`theme_setting.animate_${type}_${item}`),
            value: item
        }));
    }, [t]);

    // 主题选项
    const themeOptions = useMemo(() => [
        {label: t('theme_setting.light'), value: 'light'},
        {label: t('theme_setting.dark'), value: 'dark'}
    ], [t]);

    // 登录模板选项
    const loginTemplateOptions = useMemo(() => [
        {label: t('theme_setting.default'), value: 'default'},
        {label: 'amis', value: 'amis'}
    ], [t]);

    // 缓存动画选项，避免重复计算
    const inAnimateOptions = useMemo(() => getAnimateOptions('in'), [getAnimateOptions]);
    const outAnimateOptions = useMemo(() => getAnimateOptions('out'), [getAnimateOptions]);

    // 当前布局配置
    const { layoutMode } = settings.system_theme_setting;
    
    // 显示顶部菜单主题条件
    const showTopTheme = layoutMode !== 'double';
    
    // 显示侧边栏主题条件
    const showSiderTheme = layoutMode !== 'double' && layoutMode !== 'top';

    return (
        <Drawer open={state.openSetting}
                onClose={closeSetting}
                closeIcon={false}
                title={t('theme_setting.title')}
                footer={(
                    <Space>
                        <Badge dot
                               count={hasUnsavedChanges ? 1 : 0}
                               title={t('theme_setting.need_save')}>
                            <Button type="primary"
                                    onClick={submit}
                                    disabled={save.loading}>{t('theme_setting.save_btn')}</Button>
                        </Badge>
                        <Button onClick={closeSetting}
                                disabled={save.loading}>{t('theme_setting.cancel_btn')}</Button>
                    </Space>
                )}>
            <Form labelAlign="left" labelCol={{span: 8}} wrapperCol={{span: 16}}>
                {/* 主题色 */}
                <SettingItem label={t('theme_setting.theme_color')}>
                    <ColorPicker showText
                                 disabledAlpha
                                 disabledFormat
                                 onChange={(_, v) => handleChange('themeColor', v)}
                                 value={settings.system_theme_setting.themeColor}
                                 presets={[{
                                     label: t('theme_setting.preinstall'),
                                     colors: ['#1677FF', '#F5222D', '#FA8C16', '#52C41A', '#13A8A8', '#2F54EB', '#722ED1', '#EB2F96'],
                                 }]}/>
                </SettingItem>

                {/* 暗黑模式 */}
                <SettingItem 
                    label={t('theme_setting.dark_theme')}
                    condition={!settings.system_theme_setting.followSystemTheme}
                >
                    <Switch checked={settings.system_theme_setting.darkTheme}
                            onChange={(value) => handleChange('darkTheme', value)}/>
                </SettingItem>

                {/* 布局模式 */}
                <SettingItem label={t('theme_setting.layout_mode')}>
                    <SelectLayout current={settings.system_theme_setting.layoutMode}
                                  change={(value) => handleChange('layoutMode', value)}/>
                </SettingItem>

                {/* 登录页模板 */}
                <SettingItem label={t('theme_setting.login_template')}>
                    <Radio.Group
                        onChange={(e) => handleChange('loginTemplate', e.target.value)}
                        value={settings.system_theme_setting.loginTemplate}
                        optionType="button"
                        options={loginTemplateOptions}/>
                </SettingItem>

                {/* 顶部菜单主题 */}
                <SettingItem 
                    label={t('theme_setting.top_theme')}
                    condition={showTopTheme}
                >
                    <Radio.Group
                        onChange={(e) => handleChange('topTheme', e.target.value)}
                        value={settings.system_theme_setting.topTheme}
                        optionType="button"
                        options={themeOptions}/>
                </SettingItem>

                {/* 侧边栏主题 */}
                <SettingItem 
                    label={t('theme_setting.sider_theme')}
                    condition={showSiderTheme}
                >
                    <Radio.Group
                        onChange={(e) => handleChange('siderTheme', e.target.value)}
                        value={settings.system_theme_setting.siderTheme}
                        optionType="button"
                        options={themeOptions}/>
                </SettingItem>

                {/* 页面内容 */}
                <SettingItem label={t('theme_setting.page_content')}>
                    <Space direction="vertical">
                        <Checkbox onChange={(e) => handleChange('footer', e.target.checked)}
                                  checked={settings.system_theme_setting.footer}>{t('theme_setting.footer')}</Checkbox>
                        <Checkbox onChange={(e) => handleChange('breadcrumb', e.target.checked)}
                                  checked={settings.system_theme_setting.breadcrumb}>{t('theme_setting.breadcrumb')}</Checkbox>
                        <Checkbox onChange={(e) => handleChange('enableTab', e.target.checked)}
                                  checked={settings.system_theme_setting.enableTab}>{t('theme_setting.tab')}</Checkbox>
                        <Checkbox onChange={(e) => handleChange('tabIcon', e.target.checked)}
                                  checked={settings.system_theme_setting.tabIcon}>{t('theme_setting.tab_icon')}</Checkbox>
                    </Space>
                </SettingItem>

                {/* 进场动画 */}
                <SettingItem label={t('theme_setting.animate_in')}>
                    <InputNumber addonAfter="ms"
                                 onChange={(value) => handleChange('animateInDuration', value)}
                                 value={settings.system_theme_setting.animateInDuration}
                                 addonBefore={(
                                     <Select options={inAnimateOptions}
                                             dropdownStyle={{width: 100}}
                                             onChange={(value) => handleChange('animateInType', value)}
                                             value={settings.system_theme_setting.animateInType}/>
                                 )}/>
                </SettingItem>

                {/* 离场动画 */}
                <SettingItem label={t('theme_setting.animate_out')}>
                    <InputNumber addonAfter="ms"
                                 onChange={(value) => handleChange('animateOutDuration', value)}
                                 value={settings.system_theme_setting.animateOutDuration}
                                 addonBefore={(
                                     <Select options={outAnimateOptions}
                                             dropdownStyle={{width: 100}}
                                             onChange={(value) => handleChange('animateOutType', value)}
                                             value={settings.system_theme_setting.animateOutType}/>
                                 )}/>
                </SettingItem>

                {/* KeepAlive设置 */}
                <SettingItem label={t('theme_setting.keep_alive')}>
                    <Switch checked={settings.system_theme_setting.keepAlive}
                            onChange={(value) => handleChange('keepAlive', value)}/>
                </SettingItem>

                {/* 手风琴菜单 */}
                <SettingItem label={t('theme_setting.accordion_menu')}>
                    <Switch checked={settings.system_theme_setting.accordionMenu}
                            onChange={(value) => handleChange('accordionMenu', value)}/>
                </SettingItem>
            </Form>
        </Drawer>
    );
};

export default SettingPanel;
