export function dynamicAssetsHandler({js = [], css = [], styles = [], scripts = []}) {
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

    js?.forEach(js => loadJS(js))
    css?.forEach(css => loadCSS(css))
    scripts?.forEach(val => loadScripts(val))
    styles?.forEach(val => loadStyles(val))
}
