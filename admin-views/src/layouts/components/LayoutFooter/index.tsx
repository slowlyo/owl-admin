import useSettings from '@/hooks/useSetting'

const LayoutFooter = () => {
    const {getSetting} = useSettings()

    if(!getSetting('system_theme_setting.footer')){
        return null
    }

    return (
        <div className="owl-footer h-[65px] flex items-center justify-center bg-[var(--owl-main-bg)] border-t">
            <div dangerouslySetInnerHTML={{__html: getSetting('layout.footer')}}></div>
        </div>
    )
}

export default LayoutFooter
