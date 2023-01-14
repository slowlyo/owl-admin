import {request} from '@umijs/max'
import {getToken} from "@/utils/user"

const prefix = '/admin-api'

const get = (url: string, options?: any) => request(prefix + url, {method: 'GET', ...(options || {})})
const post = (url: string, options?: any) => request(prefix + url, {method: 'POST', ...(options || {})})

export const adminService = {
    request: async (url: string, method: any, data: any) => request(url, {method, data}),
    getSettings: async () => get('/_settings'),
    login: async (data: any) => post('/login', {data}),
    logout: async () => get('/logout'),
    captcha: async () => get('/captcha'),
    queryCurrentUser: async () => {
        if (!getToken()) {
            return null
        }

        return get('/current-user')
    },
    queryMenu: async () => {
        if (!getToken()) {
            return null
        }

        return get('/menus')
    },
    initPage: async (path: string) => get(path),
}
