import {Layout} from 'antd'
import LayoutFooter from '../components/LayoutFooter'
import LayoutLogo from '@/layouts/components/LayoutLogo'

const {Header, Sider, Content} = Layout

export const DoubleLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Sider width={65} className="border-r" theme="light">
                <LayoutLogo onlyLogo/>
            </Sider>
            <Sider width={220} className="border-r" theme="light">Sider</Sider>
            <Layout>
                <Header className="h-[64px] bg-white border-b">Header</Header>
                <Content className="overflow-auto overflow">
                    <div>Content</div>
                    <LayoutFooter/>
                </Content>
            </Layout>
        </Layout>
    )
}
