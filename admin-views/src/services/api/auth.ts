import {request} from 'umi'

/**
 * 登录
 * @param data - 登录数据
 */
export const fetchLogin = (data: any) => request('/login', {method: 'post', data})

/**
 * 获取用户信息
 */
export const fetchUserInfo = () => request('/current-user', {method: 'get'})

/**
 * 获取用户路由数据
 */
export const fetchUserRoutes = () => request('/menus', {method: 'get'})

/**
 * 登出
 */
export const fetchLogout = () => request('/logout', {method: 'get'})

/**
 * 获取验证码
 */
export const fetchCaptcha = () => request('/captcha', {method: 'get'})
