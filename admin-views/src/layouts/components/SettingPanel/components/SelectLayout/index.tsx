import {Tooltip} from 'antd'
import {useLang} from '@/hooks/useLang'
import React from 'react'
import {LayoutGroup, motion} from 'framer-motion'

// 布局模式枚举
export enum LayoutMode {
    DEFAULT = 'default',
    TOP = 'top',
    TOP_MIX = 'top-mix',
    DOUBLE = 'double',
}

// 基础样式常量
const STYLES = {
    // 卡片基础样式
    card: 'relative w-[100px] h-[60px] p-[5px] rounded-[6px] cursor-pointer bg-[var(--owl-main-bg)] shadow-md border-[2px] border-transparent'
}

// Card 组件的属性接口
interface CardProps {
    children: React.ReactNode;
    selected: boolean;
    tips: string;
    onClick: () => void;
    tipsInBottom?: boolean;
}

// SelectLayout 组件的属性接口
interface SelectLayoutProps {
    current: string;
    change: (mode: string) => void;
}

const Card = React.memo(({children, selected, tips, onClick, tipsInBottom = false}: CardProps) => {
    return (
        <Tooltip title={tips} arrow={false} placement={tipsInBottom ? 'bottom' : 'top'}>
            <motion.div 
                onClick={onClick} 
                className={STYLES.card}
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
            >
                {selected && (
                    <motion.div
                        layoutId="layout-mode-active"
                        className="absolute inset-[-2px] border-2 border-[var(--colors-brand-5)] rounded-[6px] z-10 pointer-events-none"
                        transition={{ type: "spring", stiffness: 300, damping: 30 }}
                    />
                )}
                {children}
            </motion.div>
        </Tooltip>
    )
})

const SelectLayout = ({current, change}: SelectLayoutProps) => {
    const {t} = useLang()

    return (
        <LayoutGroup id="layout-mode-select">
            <div>
                <div className="flex justify-between">
                    {/* default布局 */}
                    <Card selected={current === LayoutMode.DEFAULT}
                          tips={t('theme_setting.layout_mode_default')}
                          onClick={() => change(LayoutMode.DEFAULT)}>
                        <div className="flex h-full">
                            <div className="bg-[var(--colors-brand-5)] opacity-60 w-[20px] h-full mr-[5px] rounded-[6px]"></div>
                            <div className="flex-1 w-[60px] h-full flex flex-col">
                                <div className="bg-[var(--colors-brand-5)] opacity-90 h-[10px] mb-[5px] rounded-[6px]"></div>
                                <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded-[6px]"></div>
                            </div>
                        </div>
                    </Card>
                    {/* top布局 */}
                    <Card selected={current === LayoutMode.TOP}
                          tips={t('theme_setting.layout_mode_top')}
                          onClick={() => change(LayoutMode.TOP)}>
                        <div className="flex flex-col h-full">
                            <div className="bg-[var(--colors-brand-5)] opacity-90 h-[10px] mb-[5px] rounded-[6px]"></div>
                            <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded-[6px]"></div>
                        </div>
                    </Card>
                </div>
                <div className="flex justify-between mt-3">
                    {/* top-mix布局 */}
                    <Card selected={current === LayoutMode.TOP_MIX}
                          tips={t('theme_setting.layout_mode_top_mix')}
                          tipsInBottom
                          onClick={() => change(LayoutMode.TOP_MIX)}>
                        <div className="flex flex-col h-full">
                            <div className="bg-[var(--colors-brand-5)] opacity-90 h-[10px] rounded-[6px]"></div>
                            <div className="w-full flex flex-1 mt-[5px]">
                                <div className="bg-[var(--colors-brand-5)] opacity-60 w-[20px] mr-[5px] rounded-[6px]"></div>
                                <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded-[6px]"></div>
                            </div>
                        </div>
                    </Card>
                    {/* double布局 */}
                    <Card selected={current === LayoutMode.DOUBLE}
                          tips={t('theme_setting.layout_mode_double')}
                          tipsInBottom
                          onClick={() => change(LayoutMode.DOUBLE)}>
                        <div className="flex h-full">
                            <div className="bg-[var(--colors-brand-5)] opacity-60 w-[6px] h-auto mr-[5px] rounded-[6px]"></div>
                            <div className="bg-[var(--colors-brand-5)] opacity-60 w-[16px] h-auto mr-[5px] rounded-[6px]"></div>
                            <div className="flex-1 w-[60px] h-full flex flex-col">
                                <div className="bg-[var(--colors-brand-5)] h-[10px] mb-[5px] rounded-[6px]"></div>
                                <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded-[6px]"></div>
                            </div>
                        </div>
                    </Card>
                </div>
            </div>
        </LayoutGroup>
    )
}

export default SelectLayout
