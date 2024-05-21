<?php

namespace Slowlyo\OwlAdmin\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class AutoSetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = strtolower($this->getClientLocale());
        if (! empty($locale)) {
            // 中文
            if (in_array($locale, ['zh', 'zh_cn', 'zh-hangs'])) {
                App::setLocale('zh_CN');
            }
            // 英文
            if (in_array($locale, ['en', 'en_us'])) {
                App::setLocale('en');
            }
        }
        return $next($request);
    }

    private function getClientLocale()
    {
        $var = 'locale';
        // 从get参数获取
        $locale = request()->get($var);
        // 从post参数获取
        if (empty($locale)) {
            $locale = request()->post($var);
        }
        // 从header参数获取
        if (empty($locale)) {
            $locale = request()->header($var);
        }
        // 默认语言
        if (empty($locale)) {
            $locale = config('app.locale');
        }
        return $locale;
    }
}
