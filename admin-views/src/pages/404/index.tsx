import {Button, Result} from 'antd'
import {useLang} from '@/hooks/useLang'
import {useHistory} from 'react-router'

const NotFound = () => {
    const {t} = useLang()
    const history = useHistory()

    return (<Result
        status="404"
        title="404"
        subTitle={t('not_found.title')}
        extra={<Button type="primary" onClick={() => history.replace('/')}>{t('not_found.back_home')}</Button>}
    />)
}

export default NotFound
