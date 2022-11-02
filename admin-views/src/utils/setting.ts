export const saveSetting = (setting: unknown) => {
    localStorage.setItem('setting', JSON.stringify(setting))
}

export const getSetting = () => {
    const setting = localStorage.getItem('setting')
    if (setting) {
        return JSON.parse(setting)
    }
    return {}
}

export const getSettingItem = (key: string) => {
    const setting = getSetting()
    return setting[key] || null
}
