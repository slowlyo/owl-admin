import {useEffect, useState} from 'react'
import {useModel} from '@@/plugin-model'
import {Icon} from '@iconify/react'

const MenuModel = () => {
    const [menus, setMenus] = useState({})

    const {initialState} = useModel('@@initialState')

    const getMenus: any = (routes: any = []) => {
        if (!routes.length) {
            routes = menus
        }

        let _menus = []
        for (let route of routes) {
            if (route.meta?.hide) {
                continue
            }

            _menus.push({
                key: route.path,
                label: route.meta.title,
                icon: <Icon icon={route.meta.icon}/>,
                children: route.children ? getMenus(route.children) : null,
            })
        }

        return _menus
    }

    useEffect(() => {
        if (initialState?.extraRoutes) {
            setMenus(initialState.extraRoutes)
        }
    }, [initialState])

    return {
        menus,
        setMenus,
        getMenus
    }
}

export default MenuModel
