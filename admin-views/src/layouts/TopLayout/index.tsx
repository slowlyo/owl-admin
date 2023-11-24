import {Layout} from 'antd'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import LayoutContent from '@/layouts/components/LayoutContent'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import useSetting from '@/hooks/useSetting'

const {Header, Content} = Layout

// 顶部布局
const TopLayout = () => {
    const {getSetting} = useSetting()

    const darkTop = () => {
        return getSetting('system_theme_setting.topTheme') == 'dark' && !getSetting('system_theme_setting.darkTheme')
    }

    const border = darkTop() ? '' : 'border-b'

    return (
        <Layout className="h-screen overflow-hidden">
            <Header className={'h-[65px] flex p-0 justify-between items-center leading-none ' + border}>
                <div className="flex h-full">
                    <LayoutLogo/>
                    <div className="leading-[65px] h-full">
                        <LayoutMenu mode="horizontal" theme={darkTop() ? 'dark' : 'light'}/>
                    </div>
                </div>
                <LayoutTopBar/>
            </Header>
            <Content className="overflow-auto overflow">
                <LayoutContent/>
            </Content>
        </Layout>
    )
}

export default TopLayout
