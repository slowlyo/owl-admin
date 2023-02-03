export const settings = {
	setStore: (appStore: any) => {
		const app = appStore

		/**
		 * 获取设置
		 */
		const getSettings = () => app.$state.setting

		/**
		 * 获取设置项
		 * @param key
		 */
		const getSettingItem = (key: string) => {
			let settings = getSettings();

			return settings && settings[key];
		}

		/**
		 * 判断扩展是否启用
		 * @param extension
		 */
		const extensionIsEnable = (extension: string) => getSettingItem('enabled_extensions')?.includes(extension)

		/**
		 * 储存设置
		 * @param settings
		 */
		const setSettings = (settings: any) => app.setSetting(settings)

		return {
			getSettings,
			getSettingItem,
			extensionIsEnable,
			setSettings,
		}
	}
}
