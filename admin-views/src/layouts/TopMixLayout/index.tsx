import {Layout} from 'antd'
import LayoutLogo from '@/layouts/components/LayoutLogo'

const {Header, Footer, Content} = Layout

const TopMixLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[60px] bg-white border-b">
                <LayoutLogo/>
            </Header>
            <Content className="overflow-auto overflow">
                <div>Content</div>
            </Content>
            <Footer className="h-[60px] border-t bg-white">Footer</Footer>
        </Layout>
    )
}

export default TopMixLayout
