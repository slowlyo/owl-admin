import {addSchemaFilter, FormItem, Renderer} from 'amis'
import {getCacheKey} from '@/utils/common'
import SvgIcon from './components/SvgIcon'
import WangEditor from './components/WangEditor'
import Watermark from './components/Watermark'
import SchemaEditor from './components/SchemaEditor'

const DEFAULT_TIME_ZONE = 'Asia/Shanghai'

const dateRendererTypes = new Set([
    'date',
    'datetime',
    'time',
    'static-date',
    'static-datetime',
    'static-time',
])

let amisDisplayTimeZone = DEFAULT_TIME_ZONE

/**
 * 读取主题配置里的时区，注册阶段只读取一次，避免 schema 过滤时重复访问本地存储。
 */
const getStoredTimeZone = () => {
    try {
        const settings = JSON.parse(localStorage.getItem(getCacheKey('settings')) || '{}')

        return settings?.system_theme_setting?.timeZone || DEFAULT_TIME_ZONE
    } catch (e) {
        return DEFAULT_TIME_ZONE
    }
}

/**
 * 更新 amis 日期渲染使用的时区，设置面板即时切换时通过这里同步内存值。
 */
export const setAmisDisplayTimeZone = (timeZone?: string) => {
    amisDisplayTimeZone = timeZone || DEFAULT_TIME_ZONE
}

/**
 * 为未显式配置时区的日期展示组件补充全局时区，保留页面 schema 自身的优先级。
 */
const registerDisplayTimeZoneFilter = () => {
    setAmisDisplayTimeZone(getStoredTimeZone())

    addSchemaFilter((schema) => {
        if (!schema || !dateRendererTypes.has(schema.type) || schema.displayTimeZone) {
            return schema
        }

        return {...schema, displayTimeZone: amisDisplayTimeZone}
    })
}

export const registerCustomComponents = () => {
    const globalKey = '__owl_amis_custom_components_registered__'
    const globalAny = globalThis as any
    if (globalAny[globalKey]) {
        return
    }

    const safeRegister = (fn: () => void) => {
        try {
            fn()
        } catch (err) {
            const message = err instanceof Error ? err.message : String(err)
            if (message.includes('has already exists')) {
                return
            }

            throw err
        }
    }

    globalAny[globalKey] = true

    registerDisplayTimeZoneFilter()

    // 图标 iconify
    safeRegister(() => Renderer({type: 'custom-svg-icon', autoVar: true})(SvgIcon))
    // 富文本编辑器 wangEditor
    safeRegister(() => FormItem({type: 'custom-wang-editor', autoVar: true})(WangEditor))
    // 水印 Watermark
    safeRegister(() => Renderer({type: 'custom-watermark', autoVar: true})(Watermark))
    // editor
    safeRegister(() => FormItem({type: 'custom-amis-editor', autoVar: true})(SchemaEditor))
}
