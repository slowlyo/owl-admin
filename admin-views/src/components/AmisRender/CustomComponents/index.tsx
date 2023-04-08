import {Renderer} from "amis"
import {SvgIcon} from "./components/SvgIcon"

export const registerCustomComponents = () => {
    // svg icon
    Renderer({type: "custom-svg-icon", autoVar: true})(SvgIcon)
}
