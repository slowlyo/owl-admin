import type {LocaleMessages} from 'vue-i18n';

const locale: LocaleMessages<any> = {
	admin: {
		login: 'Login',
		remember_me: 'Remember me',
		login_successfully: 'Login successfully!',
		welcome_back: 'Welcome back {0}!',
		logout: 'Logout',
		logout_tips: 'Are you sure you want to log out?',
		user_settings: 'User Settings',
		tips: 'Tips',
		cancel: 'Cancel',
		confirm: 'Confirm',
		switch: 'Switch',
		close: 'Close',
		please_input: 'Please input {0}',
		login_form: {
			username: 'Username',
			password: 'Password',
			captcha: 'Captcha',
		},
		back_to_home: 'Back to home',
		full_screen: 'Full screen',
		topic_setting: 'Topic Setting',
		topic_mode: 'Topic Mode',
		search: 'Search',
		keyword: 'Keyword',
		no_search_result: 'No search result',
		refresh: 'Refresh',
		context_menu: {
			refresh: 'Refresh',
			close: 'Close',
			close_others: 'Close others',
			close_all: 'Close all',
			close_left: 'Close left',
			close_right: 'Close right',
		}
	}
};

export default locale;
