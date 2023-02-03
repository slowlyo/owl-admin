import {customComponents} from "./components"
import {defineCustomElement} from "vue"
import SvgIcon from "@/components/custom/SvgIcon.vue"

/**
 * 注册自定义组件
 * @param amis
 */
export const setupCustomComponent = (amis: any) => {
	for (let key in customComponents) {
		amis.Renderer({test: new RegExp(`(^|/)${key}`)})(customComponents[key])
	}
}

/**
 * 通过 web component 方式注册自定义组件, 使 vue 组件可以在 amis 中使用
 */
export const registerCustomComponent = () => {
	try {
		customElements.define("svg-icon", defineCustomElement(SvgIcon))
	} catch (e) {
	}
}
