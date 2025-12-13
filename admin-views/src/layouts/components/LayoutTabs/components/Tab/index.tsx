import React from 'react'
import {Icon} from '@iconify/react'
import {useHistory} from 'react-router'
import {useLang} from '@/hooks/useLang'
import {Dropdown} from 'antd'
import useSetting from '@/hooks/useSetting'
import useRoute from '@/routes'
import {AnimatePresence, motion} from 'framer-motion'

// Tab 项
const Tab = ({item, close, menuClick, closeable = true}) => {
    const {t} = useLang()
    const history = useHistory()
    const pathname = history.location.pathname
    const {settings} = useSetting()
    const {getCurrentRoute} = useRoute()

    if (!item) return null

    // 菜单项
    const items = [
        {label: t('tabMenu.close'), key: 'close', icon: <Icon icon="ant-design:close-outlined"/>},
        {label: t('tabMenu.closeOthers'), key: 'closeOthers', icon: <Icon icon="ant-design:column-width-outlined"/>},
        {label: t('tabMenu.closeLeft'), key: 'closeLeft', icon: <Icon icon="ri:contract-left-line"/>},
        {label: t('tabMenu.closeRight'), key: 'closeRight', icon: <Icon icon="ri:contract-right-line"/>},
        {label: t('tabMenu.closeAll'), key: 'closeAll', icon: <Icon icon="fluent:subtract-20-filled"/>}
    ]

    const currentRoute = getCurrentRoute()

    // 获取菜单
    const getMenu = () => {
        if (!closeable) {
            items.shift()
        }

        if (currentRoute?.path == item.path) {
            items.unshift({
                label: t('tabMenu.refresh'),
                key: 'refresh',
                icon: <Icon icon="ant-design:reload-outlined"/>
            })
        }

        return {items, onClick: menuClick}
    }

    const tabClass = 'relative z-[1] h-[24px] flex cursor-pointer px-[12px] text-[12px] mr-[8px] rounded-[6px] items-center justify-center border nowrap transition-all duration-300 ease-out'
    const hoverClass = ' hover:bg-[var(--colors-brand-10)] hover:text-[var(--colors-brand-6)] hover:border-[var(--colors-brand-6)]'
    const tabSelectedClass = ' text-[var(--colors-brand-6)] border-[var(--colors-brand-6)]'
    const closeClass = ' ml-[10px] hover:transform hover:scale-110 transition-all'

    return (
        <>
            {item.title && (
                <Dropdown menu={getMenu()} trigger={['contextMenu']}>
                    <div className={tabClass + hoverClass + ' ' + (pathname == item.path ? (tabSelectedClass + ' current_selected_tab') : '')}
                         onClick={() => history.push(item.path + (item?.search || ''))}>
                        <motion.span
                            className="inline-flex items-center justify-center"
                            style={{overflow: 'hidden'}}
                            animate={
                                settings.system_theme_setting.tabIcon
                                    ? {opacity: 1, scale: 1, width: 18, marginRight: 10}
                                    : {opacity: 0, scale: 0.85, width: 0, marginRight: 0}
                            }
                            transition={{duration: 0.15, ease: 'easeInOut'}}
                        >
                            <Icon icon={item.icon}/>
                        </motion.span>
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
