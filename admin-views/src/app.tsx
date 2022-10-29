import RightContent from '@/components/RightContent'
import type {Settings as LayoutSettings} from '@ant-design/pro-components'
import {SettingDrawer} from '@ant-design/pro-components'
import type {RunTimeLayoutConfig} from '@umijs/max'
import {history} from '@umijs/max'
import defaultSettings from '../config/defaultSettings'
import {errorConfig} from './requestErrorConfig'
import {adminService} from "@/services/admin"
import {parseRoutes} from "@/utils/dynamicRoutes"

// const isDev = process.env.NODE_ENV === 'development';
const loginPath = '/user/login'

/**
 * @see  https://umijs.org/zh-CN/plugins/plugin-initial-state
 * */
export async function getInitialState(): Promise<{
    settings?: Partial<LayoutSettings>;
    currentUser?: API.CurrentUser;
    loading?: boolean;
    fetchUserInfo?: () => Promise<API.CurrentUser | undefined>;
}> {
    const fetchUserInfo = async () => {
        try {
            const result: any = await adminService.queryCurrentUser()

            if (result?.code == 401) {
                history.push(loginPath)
                return
            }

            return result.data
        } catch (error) {
            history.push(loginPath)
        }
        return undefined
    }

    // 如果不是登录页面，执行
    if (window.location.pathname !== loginPath) {
        const currentUser = await fetchUserInfo()
        return {
            fetchUserInfo,
            currentUser,
            settings: defaultSettings,
        }
    }
    return {
        fetchUserInfo,
        settings: defaultSettings,
    }
}

let extraRoutes: any

export function patchClientRoutes({routes}: any) {
    // 根据 extraRoutes 对 routes 做一些修改
    parseRoutes(extraRoutes, routes)
}

export function render(oldRender: any) {
    adminService.queryMenu().then((res) => {
        extraRoutes = res.data
        oldRender()
    })
}

// ProLayout 支持的api https://procomponents.ant.design/components/layout
export const layout: RunTimeLayoutConfig = ({initialState, setInitialState}) => {
    return {
        rightContentRender: () => <RightContent/>,
        // 这里是 jio 如果你需要可以自行打开
        // footerRender: () => <Footer />,
        onPageChange: () => {
            const {location} = history
            // 如果没有登录，重定向到 login
            if (!initialState?.currentUser && location.pathname !== loginPath) {
                history.push(loginPath)
            }
        },
        layoutBgImgList: [],
        links: [],
        menuHeaderRender: undefined,
        // 自定义 403 页面
        // unAccessible: <div>unAccessible</div>,
        // 增加一个 loading 的状态
        childrenRender: (children, props) => {
            // if (initialState?.loading) return <PageLoading />;
            return (
                <>
                    {children}
                    {!props.location?.pathname?.includes('/login') && (
                        <SettingDrawer
                            disableUrlParams
                            enableDarkTheme
                            settings={initialState?.settings}
                            onSettingChange={(settings) => {
                                setInitialState((preInitialState) => ({
                                    ...preInitialState,
                                    settings,
                                }))
                            }}
                        />
                    )}
                </>
            )
        },
        title: 'Slow Admin',
        logo: 'https://gw.alipayobjects.com/zos/rmsportal/KDpgvguMpGfqaHPjicRK.svg',
        menu: {
            locale: false,
            request: async () => {
                const result: any = await adminService.queryMenu()

                const menu = result.data

                menu.forEach((item: any) => {
                    if (item?.icon) {
                        item.icon = (<i className={item.icon}></i>)
                    }
                })

                return menu
            }
        },
        ...initialState?.settings,
    }
}

/**
 * @name request 配置，可以配置错误处理
 * 它基于 axios 和 ahooks 的 useRequest 提供了一套统一的网络请求和错误处理方案。
 * @doc https://umijs.org/docs/max/request#配置
 */
export const request = {
    ...errorConfig,
}
