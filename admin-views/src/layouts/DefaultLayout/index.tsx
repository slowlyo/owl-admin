import {Layout} from 'antd'
import {LayoutFooter} from '../components/LayoutFooter'

const {Header, Sider, Content} = Layout

export const DefaultLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Sider width={220} className="border-r" theme="light">Sider</Sider>
            <Layout>
                <Header className="h-[60px] bg-white border-b">11111111Header</Header>
                <Content className="overflow-auto overflow">
                    <div>Content</div>
                    <LayoutFooter/>
                </Content>
            </Layout>
        </Layout>
    )
}
