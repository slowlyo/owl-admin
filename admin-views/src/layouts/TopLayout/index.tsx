import {Layout} from 'antd'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import LayoutContent from '@/layouts/components/LayoutContent'
import LayoutFooter from '@/layouts/components/LayoutFooter'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'

const {Header, Content} = Layout

const TopLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[64px] bg-white border-b flex p-0 justify-between items-center leading-none">
                <div className="flex">
                    <LayoutLogo/>
                    <div className="leading-[64px]">
                        <LayoutMenu mode="horizontal"/>
                    </div>
                </div>
                <LayoutTopBar/>
            </Header>
            <Content className="overflow-auto overflow">
                <LayoutContent/>
                <LayoutFooter/>
            </Content>
        </Layout>
    )
}

export default TopLayout
