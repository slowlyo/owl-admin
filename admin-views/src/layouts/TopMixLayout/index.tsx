import {Layout, Menu} from 'antd'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import {useEffect, useState} from 'react'
import LayoutContent from '@/layouts/components/LayoutContent'
import useSetting from '@/hooks/useSetting'
import useRoute from '@/routes'
import {useHistory} from 'react-router-dom'
import {Icon} from '@iconify/react'

const {Header, Sider, Content} = Layout

// 上下布局
const TopMixLayout = () => {
    const {getSetting} = useSetting()
    const {routes, getCurrentRoute} = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname

    const [childrenRoutes, setChildrenRoutes] = useState<any[]>([])
    const [selectedTopKeys, setSelectedTopKeys] = useState<string[]>([])

    const darkSider = () => {
        return getSetting('system_theme_setting.siderTheme') == 'dark' && !getSetting('system_theme_setting.darkTheme')
    }

    const darkTop = () => {
        return getSetting('system_theme_setting.topTheme') == 'dark' && !getSetting('system_theme_setting.darkTheme')
    }

    // 查找顶级菜单
    const getTopRoute = (current) => {
        if (!current) return null
        // 检查当前路由是否是一级路由
        const top = routes.find(r => r.path === current.path)
        if (top) return top

        // 检查父级
        if (current.meta?.parents?.length) {
            // parents[0] 通常是根
            const parentPath = current.meta.parents[0].path
            return routes.find(r => r.path === parentPath)
        }
        return null
    }

    useEffect(() => {
        const current = getCurrentRoute()
        const topRoute = getTopRoute(current)
        if (topRoute) {
            setSelectedTopKeys([topRoute.path])
            // 如果是一级菜单且有子菜单，显示子菜单
            if (topRoute.children && topRoute.children.length > 0) {
                setChildrenRoutes(topRoute.children)
            } else {
                setChildrenRoutes([])
            }
        }
    }, [pathname, routes])

    const handleTopClick = (info) => {
        const key = info.key
        const route = routes.find(r => r.path === key)
        if (!route) return

        if (route.is_link) {
            window.open(route.path)
            return
        }

        // 更新选中状态
        setSelectedTopKeys([key])

        if (route.children && route.children.length > 0) {
            setChildrenRoutes(route.children)
            // 查找第一个可用子菜单并跳转
            const findFirst = (children) => {
                for (let child of children) {
                    if (!child.meta?.hide) {
                        if (!child.children || child.children.length === 0) return child
                        return findFirst(child.children)
                    }
                }
                return null
            }
            const target = findFirst(route.children)
            if (target) {
                history.push(target.path)
            } else {
                history.push(route.path)
            }
        } else {
            setChildrenRoutes([])
            history.push(route.path)
        }
    }

    // 构造一级菜单项
    const topMenuItems = routes.filter(r => !r.meta?.hide).map(r => ({
        key: r.path,
        label: r.meta?.title,
        icon: r.meta?.icon ? <span className="text-[18px] flex items-center"><Icon icon={r.meta.icon}/></span> : null,
    }))

    return (
        <Layout className="h-screen overflow-hidden">
            <Header className={'h-[65px] leading-none flex justify-between items-center px-0 ' + (darkTop() ? '' : 'border-b')}>
                <div className="flex h-full items-center flex-1 overflow-hidden">
                    <LayoutLogo/>
                    
                    <div className="flex-1 h-full min-w-0 ml-4">
                        <Menu
                            mode="horizontal"
                            theme={darkTop() ? 'dark' : 'light'}
                            selectedKeys={selectedTopKeys}
                            onClick={handleTopClick}
                            items={topMenuItems}
                            className="border-none h-[65px] [&_.ant-menu-item]:flex [&_.ant-menu-item]:items-center"
                        />
                    </div>
                </div>
                <LayoutTopBar/>
            </Header>
            <Layout>
                {childrenRoutes.length > 0 && (
                    <Sider width={220}
                           className="border-r overflow-hidden"
                           theme={darkSider() ? 'dark' : 'light'}>
                        <LayoutMenu
                            theme={darkSider() ? 'dark' : 'light'}
                            routeProps={childrenRoutes}
                            collapsed={false}
                        />
                    </Sider>
                )}
                <Content className="overflow-hidden flex flex-col">
                    <div className="flex-1 overflow-hidden">
                        <LayoutContent/>
                    </div>
                </Content>
            </Layout>
        </Layout>
    )
}

export default TopMixLayout
