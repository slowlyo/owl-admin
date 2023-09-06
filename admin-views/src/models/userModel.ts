import {useEffect, useState} from 'react'
import {useRequest} from 'ahooks'
import {fetchUserInfo} from '@/services'
import {isLogin} from '@/utils/auth'

const UserModel = () => {
    const [user, setUser] = useState({})

    const requestUserInfo = useRequest(fetchUserInfo, {
        manual: true,
        onSuccess: ({data}: IRes) => {
            setUser(data)
        }
    })

    useEffect(() => {
        if (isLogin()) {
            requestUserInfo.run()
        }
    }, [])

    return {
        user,
        setUser,
        requestUserInfo
    }
}

export default UserModel
