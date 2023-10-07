import {Layout} from 'antd'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import LayoutBreadcrumb from '@/layouts/components/LayoutBreadcrumb'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import {useState} from 'react'
import CollapseTrigger from '@/layouts/components/CollapseTrigger'
import LayoutContent from '@/layouts/components/LayoutContent'
import useSetting from '@/hooks/useSetting'

const {Header, Sider, Content} = Layout

const DefaultLayout = () => {
    const {getSetting} = useSetting()
    const [collapsed, setCollapsed] = useState(false)

    return (
        <Layout className="h-screen overflow-hidden">
            <Sider width={220}
                   className={getSetting('system_theme_setting.siderTheme', 'light') == 'dark' ? '' : 'border-r'}
                   theme={getSetting('system_theme_setting.siderTheme', 'light')}
                   collapsed={collapsed}
                   collapsible
                   trigger={null}
                   collapsedWidth={65}>
                <LayoutLogo onlyLogo={collapsed}/>
                <LayoutMenu collapsed={collapsed} theme={getSetting('system_theme_setting.siderTheme', 'light')}/>
            </Sider>
            <Layout>
                <Header className="h-[65px] leading-none flex justify-between items-center border-b p-0">
                    <div className="flex h-full items-center">
                        <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>
                        <LayoutBreadcrumb/>
                    </div>
                    <LayoutTopBar/>
                </Header>
                <Content className="overflow-auto overflow">
                    <LayoutContent/>
                </Content>
            </Layout>
        </Layout>
    )
}

export default DefaultLayout
