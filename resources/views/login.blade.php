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
        html,
        body,
        .app-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
@include('slow-admin::components.load-mask')
<div id="root" class="app-wrapper"></div>
</body>

@include('slow-admin::components.js')
<script type="text/javascript">
    amisRequire('amis/embed').embed('#root', {!! $page !!}, {}, {
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
    })
</script>
</html>
