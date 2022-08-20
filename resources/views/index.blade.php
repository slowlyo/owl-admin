<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8"/>
    <title>{{ config('admin.name') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('slow-admin::components.css')
    <style>
    </style>
</head>

<body>
@include('slow-admin::components.load-mask')
<div id="root" class="app-wrapper"></div>
</body>

@include('slow-admin::components.js')
<script type="text/javascript">
    (function () {
        let amis = amisRequire('amis/embed')
        const match = amisRequire('path-to-regexp').match

        // 如果想用 browserHistory 请切换下这处代码, 其他不用变
        // const history = History.createBrowserHistory();
        const history = History.createHashHistory()

        let amisInstance = amis.embed(
            '#root',
            {!! $app !!},
            {location: history.location},
            {
                watchRouteChange: fn => {
                    return history.listen(fn)
                },
                updateLocation: (location, replace) => {
                    location = normalizeLink(location)
                    if (location === 'goBack') {
                        return history.goBack()
                    } else if (
                        (!/^https?\:\/\//.test(location) &&
                            location ===
                            history.location.pathname + history.location.search) ||
                        location === history.location.href
                    ) {
                        // 目标地址和当前地址一样，不处理，免得重复刷新
                        return
                    } else if (/^https?\:\/\//.test(location) || !history) {
                        return (window.location.href = location)
                    }

                    history[replace ? 'replace' : 'push'](location)
                },
                jumpTo: (to, action) => {
                    if (to === 'goBack') {
                        return history.goBack()
                    }

                    to = normalizeLink(to)

                    if (isCurrentUrl(to)) {
                        return
                    }

                    if (action && action.actionType === 'url') {
                        action.blank === false ? (window.location.href = to) : window.open(to, '_blank')
                        return
                    } else if (action && action.blank) {
                        window.open(to, '_blank')
                        return
                    }

                    if (/^https?:\/\//.test(to)) {
                        window.location.href = to
                    } else if (
                        (!/^https?\:\/\//.test(to) &&
                            to === history.pathname + history.location.search) ||
                        to === history.location.href
                    ) {
                        // do nothing
                    } else {
                        history.push(to)
                    }
                },
                fetcher: ({
                              url, // 接口地址
                              method, // 请求方法 get、post、put、delete
                              data, // 请求数据
                              responseType,
                              config, // 其他配置
                              headers // 请求头
                          }) => {
                    config = config || {}
                    config.withCredentials = true
                    responseType && (config.responseType = responseType)

                    if (config.cancelExecutor) {
                        config.cancelToken = new axios.CancelToken(
                            config.cancelExecutor
                        )
                    }

                    config.headers = headers || {}

                    if (method !== 'post' && method !== 'put' && method !== 'patch') {
                        if (data) {
                            config.params = data
                        }

                        return axios[method](url, config)
                    } else if (data && data instanceof FormData) {
                        config.headers = config.headers || {}
                        config.headers['Content-Type'] = 'multipart/form-data'
                    } else if (
                        data &&
                        typeof data !== 'string' &&
                        !(data instanceof Blob) &&
                        !(data instanceof ArrayBuffer)
                    ) {
                        data = JSON.stringify(data)
                        config.headers = config.headers || {}
                        config.headers['Content-Type'] = 'application/json'
                    }

                    return axios[method](url, data, config)
                },
                isCurrentUrl: isCurrentUrl,
            }
        )

        history.listen(state => {
            amisInstance.updateProps({
                location: state.location || state
            })
        })

        function normalizeLink(to, location = history.location) {
            to = to || ''

            if (to && to[0] === '#') {
                to = location.pathname + location.search + to
            } else if (to && to[0] === '?') {
                to = location.pathname + to
            }

            const idx = to.indexOf('?')
            const idx2 = to.indexOf('#')
            let pathname = ~idx
                ? to.substring(0, idx)
                : ~idx2
                    ? to.substring(0, idx2)
                    : to
            let search = ~idx ? to.substring(idx, ~idx2 ? idx2 : undefined) : ''
            let hash = ~idx2 ? to.substring(idx2) : location.hash

            if (!pathname) {
                pathname = location.pathname
            } else if (pathname[0] !== '/' && !/^https?\:\/\//.test(pathname)) {
                let relativeBase = location.pathname
                const paths = relativeBase.split('/')
                paths.pop()
                let m
                while ((m = /^\.\.?\//.exec(pathname))) {
                    if (m[0] === '../') {
                        paths.pop()
                    }
                    pathname = pathname.substring(m[0].length)
                }
                pathname = paths.concat(pathname).join('/')
            }

            return pathname + search + hash
        }

        function isCurrentUrl(to, ctx) {
            if (!to) {
                return false
            }
            const pathname = history.location.pathname
            const link = normalizeLink(to, {
                ...location,
                pathname,
                hash: ''
            })

            if (!~link.indexOf('http') && ~link.indexOf(':')) {
                let strict = ctx && ctx.strict
                return match(link, {
                    decode: decodeURIComponent,
                    strict: typeof strict !== 'undefined' ? strict : true
                })(pathname)
            }

            return decodeURI(pathname) === link
        }
    })()
</script>
</html>
