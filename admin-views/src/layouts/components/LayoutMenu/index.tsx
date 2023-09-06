import {Menu} from 'antd'
import {useState} from 'react'
import {history} from 'umi'
import {useModel} from '@@/plugin-model'

export const LayoutMenu = ({menus = []}) => {
    const [openKeys, setOpenKeys] = useState<string[]>([])
    if (!menus.length) {
        const {getMenus} = useModel('menuModel')
        menus = getMenus()
    }

    const clickMenu = (e: any) => {
        history.push(e.key)
    }

    return (
        <Menu
            className="!border-e-0 flex-1"
            mode="inline"
            openKeys={openKeys}
            onOpenChange={(keys) => setOpenKeys(keys)}
            onClick={clickMenu}
            items={menus}
        />
    )
}
