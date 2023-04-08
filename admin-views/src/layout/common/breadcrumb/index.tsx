import React, {useEffect, useState} from "react"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import {Breadcrumb as ArcoBreadcrumb, Menu} from "@arco-design/web-react"
import {useHistory} from "react-router"
import useRoute from "@/routes"
import {Icon} from "@iconify/react"

export const Breadcrumb = () => {
    const [routes] = useRoute()
    const history = useHistory()
    const pathname = history.location.pathname
    const {settings} = useSelector((state: GlobalState) => state)
    const [breadcrumb, setBreadcrumb] = useState<any[]>([])

    const routeMap = () => {
        const map = new Map()
        const travel = (_routes, level, parentNode = []) => {
            _routes.forEach((route) => {
                const getBreadcrumb = (route) => ({
                    title: route.meta?.title,
                    icon: route.meta?.icon,
                    children: route.children
                })

                map.set(route.path, [...parentNode, getBreadcrumb(route)])

                if (route?.children?.length) {
                    travel(route.children, level + 1, [...parentNode, getBreadcrumb(route)])
                }
            })
        }
        travel(routes, 0)
        return map
    }

    useEffect(() => {
        setBreadcrumb(routeMap().get(pathname) || [])
    }, [pathname, routes])

    const getDropList = (children) => {
        const list = children.filter((item) => !item.meta.hide && item.path != history.location.pathname)
        const jump = (path) => {
            history.push(path)
        }

        return (
            <Menu onClickMenuItem={jump} theme={settings.topTheme}>
                {
                    list.map((item) => (
                        <Menu.Item key={item.path}>
                            <Icon icon={item.meta.icon} className="mr-10px" style={{fontSize: "18px"}}/>
                            {item.meta.title}
                        </Menu.Item>
                    ))
                }
            </Menu>
        )
    }

    if (settings.breadcrumb === false) return (<div></div>)

    return (
        <div className="flex items-center" style={{
            // eslint-disable-next-line @typescript-eslint/ban-ts-comment
            // @ts-ignore
            "--color-text-2": settings.topTheme === "dark" ? "var(--color-text-4)" : "",
            "--color-text-1": settings.topTheme === "dark" ? "var(--color-text-4)" : "",
        }}>
            {!!breadcrumb?.length && (
                <div className="px-15px">
                    <ArcoBreadcrumb>
                        {breadcrumb.map((node, index) => {
                            let dropList = null
                            if (node.children) {
                                dropList = getDropList(node.children)
                            }

                            return (
                                <ArcoBreadcrumb.Item key={index} droplist={dropList}>
                                    {(settings.breadcrumbIcon && node.icon) && (
                                        <Icon icon={node.icon} className="mr-10px" style={{fontSize: "18px"}}/>
                                    )}
                                    {node.title}
                                </ArcoBreadcrumb.Item>
                            )
                        })
                        }
                    </ArcoBreadcrumb>
                </div>
            )}
        </div>
    )
}
