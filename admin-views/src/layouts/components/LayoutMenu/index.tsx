import {Menu} from 'antd'
import {useState} from 'react'
import {useHistory} from 'react-router'
import {Icon} from '@iconify/react'
import {useApp} from '@/hooks/useApp.ts'

export const LayoutMenu = ({routes = []}) => {
    const app = useApp()
    const history = useHistory()
    const [openKeys, setOpenKeys] = useState([])

    const currentRoutes = routes.length ? routes : app.getStore('routes')

    const clickMenu = (e) => {
        history.push(e.key)
        console.log(e)
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

    return (
        <Menu
            className="!border-e-0 flex-1"
            mode="inline"
            openKeys={openKeys}
            onOpenChange={(keys) => setOpenKeys(keys)}
            onClick={clickMenu}
            items={getMenus(currentRoutes)}
        />
    )
}
