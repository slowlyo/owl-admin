import {Button, Result} from 'antd'
import {useLang} from '@/hooks/useLang.ts'
import {useNavigate} from 'react-router'

export const NotFound = () => {
    const {t} = useLang()
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
