import {LogoutOutlined, SettingOutlined} from '@ant-design/icons'
import {history, useModel} from '@umijs/max'
import {Avatar, Menu, Spin} from 'antd'
import type {ItemType} from 'antd/es/menu/hooks/useItems'
import type {MenuInfo} from 'rc-menu/lib/interface'
import React, {useCallback} from 'react'
import {flushSync} from 'react-dom'
import HeaderDropdown from '../HeaderDropdown'
import styles from './index.less'
import {adminService} from "@/services/admin"

export type GlobalHeaderRightProps = {
    menu?: boolean;
};

const AvatarDropdown: React.FC<GlobalHeaderRightProps> = ({menu}) => {
    /**
     * 退出登录
     */
    const loginOut = async () => {
        await adminService.logout()
        // Note: There may be security issues, please note
        if (window.location.pathname !== '/user/login') {
            history.replace({
                pathname: '/user/login',
            })
        }
    }
    const {initialState, setInitialState} = useModel('@@initialState')

    const onMenuClick = useCallback(
        (event: MenuInfo) => {
            const {key} = event
            if (key === 'logout') {
                flushSync(() => {
                    setInitialState((s) => ({...s, currentUser: undefined}))
                })
                loginOut()
                return
            }
            history.push(key)
        },
        [setInitialState],
    )

    const loading = (
        <span className={`${styles.action} ${styles.account}`}>
      <Spin
          size="small"
          style={{
              marginLeft: 8,
              marginRight: 8,
          }}
      />
    </span>
    )

    if (!initialState) {
        return loading
    }

    const {currentUser} = initialState

    if (!currentUser || !currentUser.name) {
        return loading
    }

    const menuItems: ItemType[] = [
        {
            key: '/user_setting',
            icon: <SettingOutlined/>,
            label: '个人设置',
        },
        {
            type: 'divider' as const,
        },
        {
            key: 'logout',
            icon: <LogoutOutlined/>,
            label: '退出登录',
        },
    ]

    const menuHeaderDropdown = (
        <Menu className={styles.menu} selectedKeys={[]} onClick={onMenuClick} items={menuItems}/>
    )

    return (
        <HeaderDropdown overlay={menuHeaderDropdown}>
      <span className={`${styles.action} ${styles.account}`}>
        <Avatar size="small" className={styles.avatar} src={currentUser.avatar} alt="avatar"/>
        <span className={`${styles.name} anticon`}>{currentUser.name}</span>
      </span>
        </HeaderDropdown>
    )
}

export default AvatarDropdown
