export function dynamicAssetsHandler({js = [], css = [], styles = [], scripts = []}) {
    const appendToHead = (element: any) => document.getElementsByTagName("head")[0].appendChild(element)

    const loadJS = (src: string) => {
        const script = document.createElement("script")
        script.src = src
        script.type = "text/javascript"
        appendToHead(script)
    }

    const loadCSS = (href: string) => {
        const link = document.createElement("link")
        link.href = href
        link.rel = "stylesheet"
        appendToHead(link)
    }

    const loadScripts = (arr: string[]) => {
        const script = document.createElement("script")
        script.innerHTML = arr.join("")
        script.type = "text/javascript"
        appendToHead(script)
    }

    const loadStyles = (arr: string[]) => {
        const style = document.createElement("style")
        style.innerHTML = arr.join("")
        appendToHead(style)
    }

    js.forEach(js => loadJS(js))
    css.forEach(css => loadCSS(css))
    scripts.length && loadScripts(scripts)
    styles.length && loadStyles(styles)
}
