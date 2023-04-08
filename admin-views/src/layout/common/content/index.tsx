import React, {useEffect, useMemo} from "react"
import {Redirect, Route, Switch} from "react-router-dom"
import {Layout} from "@arco-design/web-react"
import {useSelector} from "react-redux"
import useRoute from "@/routes"
import lazyLoad from "@/utils/lazyload"
import {GlobalState} from "@/store"
import styles from "./style/index.module.less"
import {useHistory, useLocation} from "react-router"
import QueueAnim from "rc-queue-anim"
import {getFlattenRoutes} from "@/routes/helpers"

const ArcoContent = Layout.Content

export const Content = ({menuCollapsed}: { menuCollapsed?: boolean }) => {
    const {settings} = useSelector((state: GlobalState) => state)

    const [routes, defaultRoute] = useRoute()

    const navbarHeight = 60
    const extraWidth = settings.layoutMode == "double" ? 65 : 0
    const collapsedWidth = settings.layoutMode == "double" ? 65 : 60
    const menuWidth = menuCollapsed ? (extraWidth + collapsedWidth) : (extraWidth + settings.menuWidth)
    const noTransition = settings.layoutMode == "double" ? {transition: "none"} : {}

    const flattenRoutes = useMemo(() => getFlattenRoutes(routes) || [], [routes])

    const paddingLeft = {paddingLeft: settings.layoutMode == "top" ? 0 : menuWidth}
    const paddingTop = {paddingTop: navbarHeight}
    const paddingStyle = {...paddingLeft, ...paddingTop, ...noTransition}

    const history = useHistory()
    const pathname = history.location.pathname
    const location = useLocation()

    const setPageTitle = () => {
        const title = flattenRoutes.find((route) => route.path === pathname)?.meta?.title
        if (title) {
            document.title = title
        }
    }

    useEffect(() => {
        setPageTitle()
    }, [pathname, routes])

    return (
        <Layout className={styles["layout-content"]} style={paddingStyle}>
            <div className={styles["layout-content-wrapper"]}>
                <QueueAnim className="relative"
                           type={[settings.animateInType, settings.animateOutType]}
                           duration={[settings.animateInDuration, settings.animateInDuration]}>
                    <ArcoContent key={pathname} id={pathname} className="absolute w-full">
                        <Switch location={location}>
                            {flattenRoutes.map((route, index) => {
                                return <Route key={index} path={route.path} component={route.component}/>
                            })}
                            <Route exact path="/">
                                <Redirect to={`/${defaultRoute}`}/>
                            </Route>
                            {flattenRoutes.length && (
                                <Route
                                    path="*"
                                    component={lazyLoad(() => import("@/pages/exception/403"))}
                                />
                            )}
                        </Switch>
                    </ArcoContent>
                </QueueAnim>
            </div>
        </Layout>
    )
}
