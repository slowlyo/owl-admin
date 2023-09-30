import useSettings from '@/hooks/useSetting'

const LayoutFooter = () => {
    const {getSetting} = useSettings()

    if(!getSetting('system_theme_setting.footer')){
        return null
    }

    return (
        <div className="h-[65px] flex items-center justify-center">
            <div dangerouslySetInnerHTML={{__html: getSetting('layout.footer')}}></div>
        </div>
    )
}

export default LayoutFooter
