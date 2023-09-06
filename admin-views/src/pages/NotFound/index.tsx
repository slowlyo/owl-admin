import {Button, Result} from 'antd'
import {useIntl, useNavigate} from '@@/exports'

export const NotFound = () => {
    const {formatMessage} = useIntl()
    const t = (key: string, opt?: any) => formatMessage({id: key}, opt)
    const navigate = useNavigate()

    return (
        <div className="h-full w-full flex items-center justify-center">
            <Result
                status="404"
                title="404"
                subTitle={t('not_found.title')}
                extra={
                    <Button type="primary" onClick={() => navigate('/', {replace: true})}>
                        {t('not_found.back_home')}
                    </Button>
                }
            />
        </div>
    )
}
