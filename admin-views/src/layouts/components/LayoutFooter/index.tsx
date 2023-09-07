import {useSettings} from '@/hooks/useSettings.ts'

const LayoutFooter = () => {
    const {get} = useSettings()

    if(!get('system_theme_setting.footer')){
        return null
    }

    return (
        <div className="h-[60px] flex items-center justify-center">
            <div dangerouslySetInnerHTML={{__html: get('layout.footer')}}></div>
        </div>
    )
}

export default LayoutFooter
