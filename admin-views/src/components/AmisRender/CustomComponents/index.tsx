import {FormItem, Renderer} from 'amis'
import SvgIcon from './components/SvgIcon'
import WangEditor from './components/WangEditor'
import Watermark from './components/Watermark'
import SchemaEditor from './components/SchemaEditor'

export const registerCustomComponents = () => {
    // 图标 iconify
    Renderer({type: 'custom-svg-icon', autoVar: true})(SvgIcon)
    // 富文本编辑器 wangEditor
    FormItem({type: 'custom-wang-editor', autoVar: true})(WangEditor)
    // 水印 Watermark
    Renderer({type: 'custom-watermark', autoVar: true})(Watermark)
    // editor
    FormItem({type: 'custom-amis-editor', autoVar: true})(SchemaEditor)
}
