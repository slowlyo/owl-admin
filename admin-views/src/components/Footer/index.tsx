import {DefaultFooter} from '@ant-design/pro-components'
import {useIntl} from '@umijs/max'

const Footer: React.FC = () => {
    const intl = useIntl()
    const defaultMessage = intl.formatMessage({
        id: 'app.copyright.produced',
        defaultMessage: '这里是默认的版权信息',
    })

    const currentYear = new Date().getFullYear()

    return (
        <DefaultFooter
            style={{
                background: 'none',
            }}
            copyright={`${currentYear} ${defaultMessage}`}
            links={[]}
        />
    )
}

export default Footer
