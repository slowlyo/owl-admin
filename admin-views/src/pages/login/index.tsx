import DefaultLogin from '@/pages/login/default-login'
import {useLocation, useNavigate} from 'react-router'
import {useAuth} from '@/hooks/useAuth.ts'
import {useEffect} from 'react'

export const Login = () => {
    const navigate = useNavigate()
    const location = useLocation()
    const auth = useAuth()

    if (auth.token) {
        useEffect(() => navigate('/'), [location])
    }

    return <DefaultLogin/>
}
