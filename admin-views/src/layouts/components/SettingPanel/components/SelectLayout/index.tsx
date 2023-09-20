import {Tooltip} from 'antd'
import {useLang} from '@/hooks/useLang'

const Card = ({children, selected, tips, onClick}) => {
    const selectClass = selected ? ' border-[var(--colors-brand-5)]' : ' border-transparent'
    return (
        <Tooltip title={tips} arrow={false}>
            <div onClick={onClick}
                 className={'relative w-[100px] h-[60px] p-[5px] rounded cursor-pointer bg-white shadow border-[2px] hover:border-[var(--colors-brand-5)]' + selectClass}>
                {children}
            </div>
        </Tooltip>
    )
}

const SelectLayout = ({current, change}) => {
    const {t} = useLang()

    return (
        <div>
            <div className="flex justify-between">
                {/*default*/}
                <Card selected={current == 'default'}
                      tips={t('theme_setting.layout_mode_default')}
                      onClick={() => change('default')}>
                    <div className="flex h-full">
                        <div className="bg-[var(--colors-brand-5)] opacity-60 w-[20px] h-full mr-[5px] rounded"></div>
                        <div className="flex-1 w-[60px] h-full flex flex-col">
                            <div className="bg-[var(--colors-brand-5)] opacity-90 h-[10px] mb-[5px] rounded"></div>
                            <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded"></div>
                        </div>
                    </div>
                </Card>
                {/*top*/}
                <Card selected={current == 'top'}
                      tips={t('theme_setting.layout_mode_top')}
                      onClick={() => change('top')}>
                    <div className="flex flex-col h-full">
                        <div className="bg-[var(--colors-brand-5)] opacity-90 h-[10px] mb-[5px] rounded"></div>
                        <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded"></div>
                    </div>
                </Card>
            </div>
            <div className="flex justify-between mt-3">
                {/*top-mix*/}
                <Card selected={current == 'top-mix'}
                      tips={t('theme_setting.layout_mode_top_mix')}
                      onClick={() => change('top-mix')}>
                    <div className="flex flex-col h-full">
                        <div className="bg-[var(--colors-brand-5)] opacity-90 h-[10px] mb-[5px] rounded"></div>
                        <div className="w-full flex">
                            <div className="bg-[var(--colors-brand-5)] opacity-60 w-[20px] h-auto mr-[5px] rounded"></div>
                            <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 h-[35px] rounded"></div>
                        </div>
                    </div>
                </Card>
                {/*double*/}
                <Card selected={current == 'double'}
                      tips={t('theme_setting.layout_mode_double')}
                      onClick={() => change('double')}>
                    <div className="flex h-full">
                        <div className="bg-[var(--colors-brand-5)] opacity-60 w-[6px] h-auto mr-[5px] rounded"></div>
                        <div className="bg-[var(--colors-brand-5)] opacity-60 w-[16px] h-auto mr-[5px] rounded"></div>
                        <div className="flex-1 w-[60px] h-full flex flex-col">
                            <div className="bg-[var(--colors-brand-5)] h-[10px] mb-[5px] rounded"></div>
                            <div className="bg-[var(--colors-brand-5)] opacity-10 flex-1 rounded"></div>
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    )
}
export default SelectLayout
