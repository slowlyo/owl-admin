/**
 * 保存设置
 * @param setting
 */
export const saveSetting = (setting: unknown) => {
    localStorage.setItem('setting', JSON.stringify(setting))
}

/**
 * 获取设置
 */
export const getSetting = () => {
    const setting = localStorage.getItem('setting')
    if (setting) {
        return JSON.parse(setting)
    }
    return {}
}

/**
 * 获取设置项
 * @param key
 */
export const getSettingItem = (key: string) => {
    const setting = getSetting()
    return setting[key] || null
}

/**
 * 检查扩展是否启用
 * @param extension
 */
export const extensionIsEnable = (extension: string) => getSetting().enabled_extensions?.includes(extension)

