import {request} from '../request';

/**
 * 登录
 * @param data - 登录数据
 */
export const fetchLogin = (data: any) => request.post('/login', data);

/**
 * 获取用户信息
 */
export const fetchUserInfo = () => request.get('/current-user');

/**
 * 获取用户路由数据
 */
export const fetchUserRoutes = () => request.get('/menus')

/**
 * 登出
 */
export const fetchLogout = () => request.get('/logout')

/**
 * 获取验证码
 */
export const fetchCaptcha = () => request.get('/captcha');
