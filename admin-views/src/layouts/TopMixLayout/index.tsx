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

// 上下布局
const TopMixLayout = () => {
    const {getSetting} = useSetting()
    const [collapsed, setCollapsed] = useState(false)

    const darkSider = () => {
        return getSetting('system_theme_setting.siderTheme') == 'dark' && !getSetting('system_theme_setting.darkTheme')
    }

    const darkTop = () => {
        return getSetting('system_theme_setting.topTheme') == 'dark' && !getSetting('system_theme_setting.darkTheme')
    }

    return (
        <Layout className="h-screen overflow-hidden">
            <Header className={'h-[65px] leading-none flex justify-between items-center p-0 ' + (darkTop() ? '' : 'border-b')}>
                <div className="flex h-full items-center">
                    <LayoutLogo/>
                    <CollapseTrigger collapsed={collapsed} toggle={setCollapsed}/>
                    <LayoutBreadcrumb/>
                </div>
                <LayoutTopBar/>
            </Header>
            <Layout>
                <Sider width={220}
                       className="border-r overflow-hidden"
                       theme={darkSider() ? 'dark' : 'light'}
                       collapsed={collapsed}
                       collapsible
                       trigger={null}
                       collapsedWidth={65}>
                    <LayoutMenu theme={darkSider() ? 'dark' : 'light'}/>
                </Sider>
                <Content className="overflow-hidden">
                    <LayoutContent/>
                </Content>
            </Layout>
        </Layout>
    )
}

export default TopMixLayout
