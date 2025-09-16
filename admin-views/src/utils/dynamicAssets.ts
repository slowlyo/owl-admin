export function dynamicAssetsHandler(input?: { js?: string | string[]; css?: string | string[]; styles?: string | string[]; scripts?: string | string[] }) {
    const { js, css, styles, scripts } = input || {}
    const appendToHead = (element: any) => document.getElementsByTagName('head')[0].appendChild(element)

    const loadJS = (src: string) => {
        const script = document.createElement('script')
        script.src = src
        script.type = 'text/javascript'
        appendToHead(script)
    }

    const loadCSS = (href: string) => {
        const link = document.createElement('link')
        link.href = href
        link.rel = 'stylesheet'
        appendToHead(link)
    }

    const loadScripts = (js: string) => {
        const script = document.createElement('script')
        script.innerHTML = js
        script.type = 'text/javascript'
        appendToHead(script)
    }

    const loadStyles = (css: string) => {
        const style = document.createElement('style')
        style.innerHTML = css
        appendToHead(style)
    }

    const toArray = (val?: string | string[]) => Array.isArray(val) ? val : (val ? [val] : [])

    toArray(js).forEach(src => loadJS(src))
    toArray(css).forEach(href => loadCSS(href))
    toArray(scripts).forEach(code => loadScripts(code))
    toArray(styles).forEach(cssText => loadStyles(cssText))
}
