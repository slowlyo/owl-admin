import {Layout} from 'antd'
import {LayoutFooter} from '../components/layout-footer'

const {Header, Content} = Layout

export const SmLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[60px] bg-white border-b">Header</Header>
            <Content className="overflow-auto overflow">
                <div>Content</div>
                <LayoutFooter/>
            </Content>
        </Layout>
    )
}
