import DefaultLogin from '@/pages/login/default-login'
import {useHistory} from 'react-router-dom'
import {useAuth} from '@/hooks/useAuth.ts'
import {useEffect} from 'react'

export const Login = () => {
    const history = useHistory()
    const auth = useAuth()

    if (auth.token) {
        useEffect(() => history.push('/'), [history.location])
    }

    return <DefaultLogin/>
}
