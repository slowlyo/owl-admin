import {Layout} from 'antd'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import LayoutFooter from '@/layouts/components/LayoutFooter'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutContent from '@/layouts/components/LayoutContent'
import {useMount} from 'ahooks'

const {Header, Content} = Layout

const SmLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[64px] leading-none flex justify-between items-center bg-white border-b p-0">
                <div className="flex h-full items-center px-6">
                    <LayoutLogo onlyLogo/>
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

export default SmLayout
