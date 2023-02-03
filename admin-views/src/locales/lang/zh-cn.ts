import type {LocaleMessages} from 'vue-i18n';

const locale: LocaleMessages<any> = {
	admin: {
		login: '登录',
		remember_me: '记住我',
		login_successfully: '登录成功！',
		welcome_back: '欢迎回来，{0}！',
		logout: '退出登录',
		logout_tips: '确定退出登录吗？',
		user_settings: '个人设置',
		tips: '提示',
		cancel: '取消',
		confirm: '确认',
		switch: '切换',
		close: '关闭',
		please_input: '请输入{0}',
		login_form: {
			username: '用户名',
			password: '密码',
			captcha: '验证码',
		},
		back_to_home: '返回首页',
		full_screen: '全屏',
		topic_setting: '主题设置',
		topic_mode: '主题模式',
		search: '搜索',
		keyword: '关键字',
		no_search_result: '暂无搜索结果',
		refresh: '刷新',
		context_menu: {
			refresh: '刷新',
			close: '关闭',
			close_others: '关闭其他',
			close_all: '关闭所有',
			close_left: '关闭左侧',
			close_right: '关闭右侧',
		}
	}
};

export default locale;
