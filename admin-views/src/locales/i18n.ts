import type {App} from 'vue';
import {createI18n} from 'vue-i18n';
import messages from './lang';

const i18n = createI18n({
	locale: 'zh-CN',
	fallbackLocale: 'en',
	messages
});

export function setupI18n(app: App) {
	app.use(i18n);
}

// @ts-ignore
export const t = (key: string, replace: object | array = null) => i18n.global.t(key, replace);

export function setLocale(locale: any) {
	i18n.global.locale = locale;
}
