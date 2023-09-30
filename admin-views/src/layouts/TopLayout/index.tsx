import {Layout} from 'antd'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import LayoutContent from '@/layouts/components/LayoutContent'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import useSetting from '@/hooks/useSetting'

const {Header, Content} = Layout

const TopLayout = () => {
    const {getSetting} = useSetting()

    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[65px] border-b flex p-0 justify-between items-center leading-none">
                <div className="flex">
                    <LayoutLogo/>
                    <div className="leading-[65px]">
                        <LayoutMenu mode="horizontal" theme={getSetting('system_theme_setting.topTheme')}/>
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
