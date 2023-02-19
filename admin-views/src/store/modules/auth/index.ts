import {nextTick} from 'vue';
import {defineStore} from 'pinia';
import {fetchLogin, fetchLogout, fetchUserInfo} from '@/service';
import {useRouterPush} from '@/composables';
import {localStg} from '@/utils';
import {useTabStore} from '../tab';
import {useRouteStore} from '@/store';
import {getToken, getUserInfo, clearAuthStorage} from './helpers';
import {t} from '@/locales';

interface AuthState {
	/** 用户信息 */
	userInfo: Auth.UserInfo;
	/** 用户token */
	token: string;
	/** 登录的加载状态 */
	loginLoading: boolean;
}

export const useAuthStore = defineStore('auth-store', {
	state: (): AuthState => ({
		userInfo: getUserInfo(),
		token: getToken(),
		loginLoading: false
	}),
	getters: {
		/** 是否登录 */
		isLogin(state) {
			return Boolean(state.token);
		}
	},
	actions: {
		/** 重置auth状态 */
		resetAuthStore() {
			const {toLogin} = useRouterPush(false);
			const {resetTabStore} = useTabStore();
			const {resetRouteStore} = useRouteStore();

			fetchLogout().then((res: any) => {
				if (res.status == 0) {
					clearAuthStorage();
					this.$reset();

					toLogin();

					nextTick(() => {
						resetTabStore();
						resetRouteStore();
					});
				}
			})
		},
		/**
		 * 处理登录后成功或失败的逻辑
		 * @param backendToken - 返回的token
		 * @param isRemember
		 */
		async handleActionAfterLogin(backendToken: string, isRemember: boolean) {
			const route = useRouteStore();
			const {toLoginRedirect} = useRouterPush(false);

			const loginSuccess = await this.loginByToken(backendToken, isRemember);

			if (loginSuccess) {
				await route.initAuthRoute();

				// 跳转登录后的地址
				toLoginRedirect();

				// 登录成功弹出欢迎提示
				if (route.isInitAuthRoute) {
					window.$notification?.success({
						title: t('admin.login_successfully'),
						// content: `欢迎回来，${this.userInfo.name}!`,
						content: t('admin.welcome_back', [this.userInfo.name]),
						duration: 3000
					});
				}

				return;
			}

			// 不成功则重置状态
			this.resetAuthStore();
		},
		/**
		 * 根据token进行登录
		 * @param token - 返回的token
		 * @param isRemember
		 */
		async loginByToken(token: string, isRemember: boolean) {
			let successFlag = false;

			// 先把token存储到缓存中(后面接口的请求头需要token)
			let setAction = isRemember ? localStg.setForever : localStg.set;

			setAction('token', token);

			// 获取用户信息
			const {data} = await fetchUserInfo();
			if (data) {
				// 成功后把用户信息存储到缓存中
				setAction('userInfo', data as Auth.UserInfo)

				// 更新状态
				this.userInfo = data as Auth.UserInfo;
				this.token = token;

				successFlag = true;
			}

			return successFlag;
		},
		/**
		 * 登录
		 * @param form
		 * @param remember
		 */
		async login(form: object, remember: boolean) {
			this.loginLoading = true;
			const {data, status} = await fetchLogin(form) as any;

			if (status != 0) {
				this.loginLoading = false;

				window.$message?.error(data?.msg);

				return true
			}

			await this.handleActionAfterLogin(data.token, remember);

			this.loginLoading = false;

			return false
		},
	}
});
