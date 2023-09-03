import {FormItem, Renderer} from "amis"
import SvgIcon from "./components/SvgIcon"
import WangEditor from "./components/WangEditor"

export const registerCustomComponents = () => {
    // svg icon
    Renderer({type: "custom-svg-icon", autoVar: true})(SvgIcon)
    // wangEditor
    FormItem({type: "custom-wang-editor", autoVar: true})(WangEditor as any)
}
