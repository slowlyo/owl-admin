window.$owl = window.$owl || {}
window.$owl.appLoader = () => {
    const cacheKey = window.$adminApiPrefix.replace(/^\//, '') + '-appSettings'
    const appSettings = JSON.parse(localStorage.getItem(cacheKey))
    const color = appSettings?.system_theme_setting?.themeColor || '#1C1C1C'

    const loader = `
<style>
        body{ margin: 0; padding: 0; }
        #app-loader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; font-size: 20px; display: flex; align-items: center; justify-content: center; background-color: white; z-index: 9999; }
        #app-loader .circle { position: absolute; width: 42px; height: 42px; opacity: 0; transform: rotate(225deg); animation-iteration-count: infinite; animation-name: orbit; animation-duration: 5s; }
        #app-loader .circle:after { content: ''; position: absolute; width: 8px; height: 8px; border-radius: 8px; background: ${color}; }
        #app-loader .circle:nth-child(2) { animation-delay: 240ms; }
        #app-loader .circle:nth-child(3) { animation-delay: 480ms; }
        #app-loader .circle:nth-child(4) { animation-delay: 720ms; }
        #app-loader .circle:nth-child(5) { animation-delay: 960ms; }
        @keyframes orbit {
            0% { transform: rotate(225deg); opacity: 1; animation-timing-function: ease-out; }
            7% { transform: rotate(345deg); animation-timing-function: linear; }
            30% { transform: rotate(455deg); animation-timing-function: ease-in-out; }
            39% { transform: rotate(690deg); animation-timing-function: linear; }
            70% { transform: rotate(815deg); opacity: 1; animation-timing-function: ease-out; }
            75% { transform: rotate(945deg); animation-timing-function: ease-out; }
            76% { transform: rotate(945deg); opacity: 0; }
            100% { transform: rotate(945deg); opacity: 0; }
        }
</style>
<div id="app-loader">
    <div class='circle'></div>
    <div class='circle'></div>
    <div class='circle'></div>
    <div class='circle'></div>
    <div class='circle'></div>
</div>
    `

    document.body.children.item(0).insertAdjacentHTML('afterend', loader)
}

window.$owl.appLoader()
