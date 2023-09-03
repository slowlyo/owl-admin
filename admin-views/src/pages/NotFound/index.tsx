import {Button, Result} from 'antd'
import {useLang} from '@/hooks/useLang.ts'
import {useHistory} from 'react-router'

export const NotFound = () => {
    const {t} = useLang()
    const history = useHistory()

    return (
        <div className="h-full w-full flex items-center justify-center">
            <Result
                status="404"
                title="404"
                subTitle={t('not_found.title')}
                extra={
                    <Button type="primary" onClick={() => history.push('/', {replace: true})}>
                        {t('not_found.back_home')}
                    </Button>
                }
            />
        </div>
    )
}
