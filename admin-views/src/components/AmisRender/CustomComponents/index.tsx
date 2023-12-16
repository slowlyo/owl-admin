import {FormItem, Renderer} from 'amis'
import SvgIcon from './components/SvgIcon'
import WangEditor from './components/WangEditor'
import Watermark from './components/Watermark'

export const registerCustomComponents = () => {
    // 图标 iconify
    Renderer({type: 'custom-svg-icon', autoVar: true})(SvgIcon)
    // 富文本编辑器 wangEditor
    FormItem({type: 'custom-wang-editor', autoVar: true})(WangEditor as any)
    // 水印 Watermark
    Renderer({type: 'custom-watermark', autoVar: true})(Watermark)
}
