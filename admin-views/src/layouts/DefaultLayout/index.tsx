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

// 默认布局
const DefaultLayout = () => {
    const {getSetting} = useSetting()
    const [collapsed, setCollapsed] = useState(false)

    const darkSider = () => {
        return getSetting('system_theme_setting.siderTheme') == 'dark' && !getSetting('system_theme_setting.darkTheme')
    }

    return (
        <Layout className="h-screen overflow-hidden">
            <Sider width={220}
                   className={darkSider() ? '' : 'border-r'}
                   theme={darkSider() ? 'dark' : 'light'}
                   collapsed={collapsed}
                   collapsible
                   trigger={null}
                   collapsedWidth={65}>
                <LayoutLogo onlyLogo={collapsed}/>
                <div className="h-[calc(100%-65px)] overflow-hidden">
                    <LayoutMenu collapsed={collapsed} theme={darkSider() ? 'dark' : 'light'}/>
                </div>
            </Sider>
            <Layout>
                <Header className="h-[65px] leading-none flex justify-between items-center border-b p-0">
                    <div className="flex h-full items-center">
                        <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>
                        <LayoutBreadcrumb/>
                    </div>
                    <LayoutTopBar/>
                </Header>
                <Content className="overflow-hidden">
                    <LayoutContent/>
                </Content>
            </Layout>
        </Layout>
    )
}

export default DefaultLayout
