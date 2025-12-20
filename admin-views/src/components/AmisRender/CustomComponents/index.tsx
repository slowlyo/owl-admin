import {FormItem, Renderer} from 'amis'
import SvgIcon from './components/SvgIcon'
import WangEditor from './components/WangEditor'
import Watermark from './components/Watermark'
import SchemaEditor from './components/SchemaEditor'

export const registerCustomComponents = () => {
    const globalKey = '__owl_amis_custom_components_registered__'
    const globalAny = globalThis as any
    if (globalAny[globalKey]) {
        return
    }

    const safeRegister = (fn: () => void) => {
        try {
            fn()
        } catch (err) {
            const message = err instanceof Error ? err.message : String(err)
            if (message.includes('has already exists')) {
                return
            }

            throw err
        }
    }

    globalAny[globalKey] = true

    // 图标 iconify
    safeRegister(() => Renderer({type: 'custom-svg-icon', autoVar: true})(SvgIcon))
    // 富文本编辑器 wangEditor
    safeRegister(() => FormItem({type: 'custom-wang-editor', autoVar: true})(WangEditor))
    // 水印 Watermark
    safeRegister(() => Renderer({type: 'custom-watermark', autoVar: true})(Watermark))
    // editor
    safeRegister(() => FormItem({type: 'custom-amis-editor', autoVar: true})(SchemaEditor))
}
