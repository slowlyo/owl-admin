import {useState} from 'react'
import IconButton from '@/layouts/components/IconButton'

const RefreshButton = () => {
    const [refreshing, setRefreshing] = useState(false)

    return (
        <IconButton icon="ant-design:reload-outlined" iconClassName={refreshing ? ' animate-spin' : ''} onClick={() => {
            setRefreshing(true)
            window.$owl.refreshAmisPage().then(() => {
                setTimeout(() => setRefreshing(false), 500)
            })
        }}/>
    )
}
export default RefreshButton
