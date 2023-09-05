import {Layout} from 'antd'
// import {LayoutFooter} from '../components/LayoutFooter'
// import {LayoutMenu} from '@/layouts/components/LayoutMenu'
// import {LayoutLogo} from '@/layouts/components/LayoutLogo'
// import {useRouter} from '@/hooks/useRouter.tsx'
import {LayoutBreadcrumb} from '@/layouts/components/LayoutBreadcrumb'
import {LayoutTopBar} from '@/layouts/components/LayoutTopBar'
import {useState} from 'react'
import {CollapseTrigger} from '@/layouts/components/CollapseTrigger'
// import {LayoutContent} from '@/layouts/components/LayoutContent'

const {Header, Sider, Content} = Layout

export const DefaultLayout = () => {
    const [collapsed, setCollapsed] = useState(false)

    return (
        <Layout className="h-screen overflow-hidden">
            <Sider width={220}
                   className="border-r"
                   theme="light"
                   collapsed={collapsed}
                   collapsible
                   trigger={<CollapseTrigger collapsed={collapsed} toggle={setCollapsed} />}
                   collapsedWidth={60}>
                {/*<LayoutLogo onlyLogo={collapsed}/>*/}
                {/*<LayoutMenu/>*/}
            </Sider>
            <Layout>
                <Header className="h-[60px] leading-none flex justify-between items-center bg-white border-b">
                    <LayoutBreadcrumb/>
                    <LayoutTopBar/>
                </Header>
                <Content className="overflow-auto overflow">
                    {/*<LayoutContent/>*/}
                    {/*<LayoutFooter/>*/}
                </Content>
            </Layout>
        </Layout>
    )
}
