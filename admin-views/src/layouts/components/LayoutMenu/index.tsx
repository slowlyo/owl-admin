import {Menu} from 'antd'
import {useEffect, useState} from 'react'
import {useRouter} from '@/hooks/useRouter.tsx'
import {useNavigate} from 'react-router'

export const LayoutMenu = ({menus = []}) => {
    const router = useRouter()
    const navigate = useNavigate()
    const [openKeys, setOpenKeys] = useState([])

    const clickMenu = (e) => {
        navigate(e.key)
        console.log(e)
    }

    return (
        <Menu
            className="!border-e-0 flex-1"
            mode="inline"
            openKeys={openKeys}
            onOpenChange={(keys) => setOpenKeys(keys)}
            onClick={clickMenu}
            items={menus.length ? menus : router.getMenus()}
        />
    )
}
