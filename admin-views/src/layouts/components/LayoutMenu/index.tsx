import {Menu} from 'antd'
import {useEffect, useState} from 'react'
import {useHistory} from 'react-router'
import {Icon} from '@iconify/react'
import useApp from '@/hooks/useApp.tsx'
import {useRouter} from '@/hooks/useRouter.tsx'

const LayoutMenu = ({routes = []}) => {
    const app = useApp()
    const router = useRouter()
    const history = useHistory()
    const pathname = history.location.pathname
    const [openKeys, setOpenKeys] = useState([])
    const [selectedKeys, setSelectedKeys] = useState([])

    const currentMenus = routes.length ? routes : app.getStore('routes')
    const currentRoute = router.getFlattenRoutes().find((item) => item.path == pathname)

    const clickMenu = (e) => {
        history.push(e.key)
        initMenuState()
    }

    const getMenus = (routes = []) => {
        let menus = []
        for (let route of routes) {
            if (route.meta?.hide) {
                continue
            }

            menus.push({
                key: route.path,
                label: route.meta.title,
                icon: <Icon icon={route.meta.icon}/>,
                children: route.children ? getMenus(route.children) : null,
            })
        }

        return menus
    }

    const initMenuState = () => {
        const open = [currentRoute?.path]
        const travel = (route) => {
            if (route?.meta?.parents) {
                route.meta.parents.map((item) => {
                    open.push(item?.path)
                    travel(item)
                })
            }
        }

        travel(currentRoute)
        setOpenKeys([...openKeys, ...open])
        setSelectedKeys([currentRoute?.path])
    }

    useEffect(() => {
        initMenuState()
    }, [pathname, currentRoute])

    return (
        <Menu
            className="!border-e-0 flex-1"
            mode="inline"
            openKeys={openKeys}
            selectedKeys={selectedKeys}
            onOpenChange={(keys) => setOpenKeys(keys)}
            onClick={clickMenu}
            items={getMenus(currentMenus)}
        />
    )
}

export default LayoutMenu
