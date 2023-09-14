import {Layout} from 'antd'
import LayoutFooter from '../components/LayoutFooter'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutContent from '@/layouts/components/LayoutContent'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import CollapseTrigger from '@/layouts/components/CollapseTrigger'
import LayoutBreadcrumb from '@/layouts/components/LayoutBreadcrumb'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import {useState} from 'react'

const {Header, Sider, Content} = Layout

export const DoubleLayout = () => {
    const [collapsed, setCollapsed] = useState(false)

    return (
        <Layout className="h-screen overflow-hidden">
            <Sider collapsedWidth={64} className="border-r" theme="dark" collapsed>
                <LayoutLogo onlyLogo/>
                <LayoutMenu collapsed theme="dark"/>
            </Sider>
            <Sider width={220} collapsedWidth={64} className="border-r" theme="light" collapsed={collapsed}>
                {!collapsed && (
                    <div className="h-[64px] border-b">

                    </div>
                )}

                <LayoutMenu collapsed={collapsed}/>
            </Sider>
            <Layout>
                <Header className="h-[64px] leading-none flex justify-between items-center bg-white border-b p-0">
                    <div className="flex h-full items-center">
                        <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>
                        <LayoutBreadcrumb/>
                    </div>
                    <LayoutTopBar/>
                </Header>
                <Content className="overflow-auto overflow">
                    <LayoutContent/>
                    <LayoutFooter/>
                </Content>
            </Layout>
        </Layout>
    )
}
