import React from 'react'
import {Icon} from '@iconify/react'
import {useHistory} from 'react-router'
import {useLang} from '@/hooks/useLang'
import {Dropdown} from 'antd'
import useSetting from '@/hooks/useSetting'

// Tab 项
const Tab = ({item, close, menuClick, closeable = true}) => {
    const {t} = useLang()
    const history = useHistory()
    const pathname = history.location.pathname
    const {settings} = useSetting()

    if (!item) return null

    // 菜单项
    const items = [
        {label: t('tabMenu.close'), key: 'close', icon: <Icon icon="ant-design:close-outlined"/>},
        {label: t('tabMenu.closeOthers'), key: 'closeOthers', icon: <Icon icon="ant-design:column-width-outlined"/>},
        {label: t('tabMenu.closeLeft'), key: 'closeLeft', icon: <Icon icon="ri:contract-left-line"/>},
        {label: t('tabMenu.closeRight'), key: 'closeRight', icon: <Icon icon="ri:contract-right-line"/>},
        {label: t('tabMenu.closeAll'), key: 'closeAll', icon: <Icon icon="fluent:subtract-20-filled"/>}
    ]

    // 获取菜单
    const getMenu = () => {
        if (!closeable) {
            items.shift()
        }
        return {items, onClick: menuClick}
    }

    const tabClass = 'h-[24px] flex cursor-pointer px-[12px] text-[12px] mr-[8px] rounded-[6px] items-center justify-center border nowrap'
    const hoverClass = ' hover:bg-[var(--colors-brand-10)] hover:text-[var(--colors-brand-6)] hover:border-[var(--colors-brand-6)]'
    const tabSelectedClass = ' bg-[var(--colors-brand-10)] text-[var(--colors-brand-6)] border-[var(--colors-brand-6)]'
    const closeClass = ' ml-[10px] hover:transform hover:scale-110 transition-all'

    return (
        <>
            {item.title && (
                <Dropdown menu={getMenu()} trigger={['contextMenu']}>
                    <div className={tabClass + hoverClass + ' ' + (pathname == item.path ? (tabSelectedClass + ' current_selected_tab') : '')}
                         onClick={() => history.push(item.path + (item?.search || ''))}>
                        {settings.system_theme_setting.tabIcon && <Icon icon={item.icon} className="mr-[10px]"/>}
                        {item.title}
                        {closeable && (
                            <Icon icon="mdi:close" className={closeClass} onClick={(e) => {
                                e.stopPropagation()
                                close(item)
                            }}/>
                        )}
                    </div>
                </Dropdown>
            )}
        </>
    )
}

export default Tab
