import IconButton from '@/layouts/components/IconButton'
import useStore from '@/hooks/useStore'

const SettingButton = () => {
    const {state, dispatch} = useStore()
    const toggle = () => {
        dispatch({
            type: 'update-open-setting',
            payload: {openSetting: !state.openSetting}
        })
    }

    return (
        <IconButton icon="ant-design:setting-outlined" onClick={toggle}/>
    )
}

export default SettingButton
