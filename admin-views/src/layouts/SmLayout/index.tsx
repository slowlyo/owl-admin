import {Drawer, Layout} from 'antd'
import LayoutTopBar from '@/layouts/components/LayoutTopBar'
import LayoutContent from '@/layouts/components/LayoutContent'
import {useState} from 'react'
import CollapseTrigger from '@/layouts/components/CollapseTrigger'
import LayoutMenu from '@/layouts/components/LayoutMenu'
import LayoutLogo from '@/layouts/components/LayoutLogo'
import useSetting from '@/hooks/useSetting'

const {Header, Content} = Layout

const SmLayout = () => {
    const {getSetting} = useSetting()
    const [closed, setClosed] = useState(true)

    return (
        <Layout className="h-screen overflow-hidden">
            <Header className="h-[65px] leading-none flex justify-between items-center border-b p-0">
                <div className="flex h-full items-center px-3">
                    <CollapseTrigger collapsed={closed} toggle={setClosed}/>
                </div>
                <LayoutTopBar/>
            </Header>
            <Content className="overflow-auto overflow">
                <LayoutContent/>
            </Content>
            <Drawer bodyStyle={{padding: '5px 0'}}
                    width={220}
                    open={!closed}
                    className={getSetting('system_theme_setting.siderTheme') == 'dark' ? '!bg-[#001529]' : ''}
                    placement="left"
                    onClose={() => setClosed(true)}
                    closeIcon={false}
                    headerStyle={{padding: 0, height: '64px'}}
                    title={<LayoutLogo/>}>
                <LayoutMenu collapsed={!open} theme={getSetting('system_theme_setting.siderTheme')}/>
            </Drawer>
        </Layout>
    )
}

export default SmLayout
