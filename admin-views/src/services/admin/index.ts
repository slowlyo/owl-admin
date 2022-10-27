import {request} from '@umijs/max'

export async function base(options?: { [key: string]: any }) {
    return request('/admin/base', {
        method: 'GET',
        ...(options || {}),
    })
}

const get = (url: string, options?: any) => request(url, {method: 'GET', ...(options || {})})
const post = (url: string, options?: any) => request(url, {method: 'POST', ...(options || {})})

export const adminService = {
    request: async (url: string, method: any, data: any) => request(url, {method, data}),

    login: async (data: any) => post('/admin/login', {data}),
    logout: async () => get('/admin/logout'),
    queryCurrentUser: async () => get('/admin/current-user'),
    queryMenu: async () => get('/admin/menus'),
    initPage: async (path: string) => get('/admin/' + path),

    captcha: async (options?: any) => get('/admin/login/reload-captcha', options),
}
