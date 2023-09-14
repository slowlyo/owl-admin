import {useFullscreen} from 'ahooks'
import IconButton from '@/layouts/components/IconButton'

const FullscreenButton = () => {
    const [isFullscreen, {toggleFullscreen}] = useFullscreen(document.getElementById('root'))

    return (
        <IconButton icon={isFullscreen ? 'ant-design:fullscreen-exit-outlined' : 'ant-design:fullscreen-outlined'}
                    onClick={() => toggleFullscreen()}/>
    )
}

export default FullscreenButton
