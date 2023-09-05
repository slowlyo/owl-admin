import {Layout} from 'antd'

const {Header, Footer, Content} = Layout

export const TopLayout = () => {
    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[60px] bg-white border-b">
            </Header>
            <Content className="overflow-auto overflow">
                <div>Content</div>
            </Content>
            <Footer className="h-[60px] border-t bg-white">Footer</Footer>
        </Layout>
    )
}
