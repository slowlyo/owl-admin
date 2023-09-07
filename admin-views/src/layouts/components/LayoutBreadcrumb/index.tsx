import {useRouter} from '@/hooks/useRouter.tsx'
import {useHistory} from 'react-router'
import {useEffect, useState} from 'react'
import {Breadcrumb} from 'antd'

const LayoutBreadcrumb = () => {
    const router = useRouter()
    const history = useHistory()
    const [items, setItems] = useState([])

    const getParents = (pathname) => {
        const currentRoute = router.getFlattenRoutes().find((item) => item.path == pathname)
        const parents = [{title: currentRoute?.meta?.title}]
        const travel = (route) => {
            if (route?.meta?.parents) {
                route.meta.parents.map((item) => {
                    let _item = {title: item.meta.title}

                    if (item?.children) {

                    }
                    parents.unshift(_item)
                    travel(item)
                })
            }
        }

        travel(currentRoute)
        setItems(parents)
    }

    history.listen((e) => getParents(e.pathname))

    useEffect(() => {
        getParents(history.location.pathname)
    }, [])

    return (
        <Breadcrumb items={items}/>
    )
}

export default LayoutBreadcrumb
