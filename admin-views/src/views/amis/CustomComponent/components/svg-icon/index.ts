// svg-icon组件

// @ts-ignore
const React = amisRequire("react")

export const AmisSvgIcon = (props: any) => {
	let dom = React.useRef(null)
	let icon = props.icon

	if (icon.startsWith("${") && icon.endsWith("}")) {
		icon = props?.value
	}

	React.useEffect(function () {
		dom.current.innerHTML = `<svg-icon class="${props.className}" icon="${icon}" />`
	})

	return React.createElement("div", {ref: dom})
}
