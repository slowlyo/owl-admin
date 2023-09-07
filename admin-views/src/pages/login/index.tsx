import DefaultLogin from '@/pages/login/default-login'
import {useAuth} from '@/hooks/useAuth.ts'
import {useEffect} from 'react'
import {useHistory} from 'react-router'

const Login = () => {
    const history = useHistory()
    const auth = useAuth()

    if (auth.token) {
        useEffect(() => history.push('/'), [history.location])
    }

    return <DefaultLogin/>
}

export default Login
