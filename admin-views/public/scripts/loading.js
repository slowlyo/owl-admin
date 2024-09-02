window.$owl = window.$owl || {}

window.$owl.appLoader = () => {
    const value = localStorage.getItem(window.$adminApiPrefix.replace(/^\//, '') + '-settings')
    const settings = JSON.parse(value == 'undefined' ? '{}' : value)
    const color = settings?.system_theme_setting?.themeColor || '#1C1C1C'
    const bgColor = settings?.system_theme_setting?.darkTheme ? '#1f1f1f' : '#FFFFFF'

    const loader = `
<div id="app-loader">
    <style>
        body{ margin: 0; padding: 0; }
        #app-loader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; font-size: 20px; display: flex; align-items: center; justify-content: center; background-color: ${bgColor}; z-index: 9999; }
        .loader { position: relative; display: inline-block; font-size: 20px; width: 40px; height: 40px; transform: rotate(45deg); animation: antRotate 1.2s infinite linear;}
        .loader i { width: 16px; height: 16px; border-radius: 100%; background-color: ${color}; transform: scale(0.75); display: block; position: absolute; opacity: 0.3; animation: antSpinMove 1s infinite linear alternate; transform-origin: 50% 50%; }
        .loader i:nth-child(1) { left: 0; top: 0; } .loader i:nth-child(2) { right: 0; top: 0; animation-delay: 0.4s; }
        .loader i:nth-child(3) { right: 0; bottom: 0; animation-delay: 0.8s; } .loader i:nth-child(4) { left: 0; bottom: 0; animation-delay: 1.2s; }
        @keyframes antSpinMove { to { opacity: 1; } } @keyframes antRotate { to { transform: rotate(405deg); } }
    </style>
    <div>
        <span class="loader"><i></i> <i></i> <i></i> <i></i></span>
    </div>
</div>
    `

    document.body.children.item(0).insertAdjacentHTML('afterend', loader)
}

window.$owl.appLoader()
