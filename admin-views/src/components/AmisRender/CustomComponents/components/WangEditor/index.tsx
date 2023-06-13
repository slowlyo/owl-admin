import "@wangeditor/editor/dist/css/style.css" // 引入 css

import React, {useState, useEffect, forwardRef} from "react"
import {useSelector} from "react-redux"
import {GlobalState} from "@/store"
import {i18nChangeLanguage} from "@wangeditor/editor"
import {Editor, Toolbar} from "@wangeditor/editor-for-react"
import {IDomEditor, IEditorConfig, IToolbarConfig} from "@wangeditor/editor"

interface IProps {
    className?: string,
    height?: number,
    placeholder?: string,
    value?: string,
    disabled?: boolean,
    static?: boolean,
    autoFocus?: boolean,
    maxLength?: number,
    toolbarKeys?: object,
    insertKeys?: object,
    excludeKeys?: object,
    uploadImageServer?: string,
    uploadImageMaxSize?: number,
    uploadImageMaxNumber?: number,
    uploadVideoServer?: string,
    uploadVideoMaxSize?: number,
    uploadVideoMaxNumber?: number,
    onChange?: (html: string) => void,
}

const WangEditor = forwardRef((props: IProps, ref: any) => {
    const {appSettings} = useSelector((state: GlobalState) => state)
    const locale = appSettings.locale == "zh_CN" ? "zh-CN" : "en"

    // editor 实例
    const [editor, setEditor] = useState<IDomEditor | null>(null)

    // 编辑器内容
    const [html, setHtml] = useState(props.value || "")

    // 工具栏配置
    const toolbarConfig: Partial<IToolbarConfig> = {}

    if (props.toolbarKeys) {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        toolbarConfig.toolbarKeys = props.toolbarKeys
    }
    if (props.insertKeys) {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        toolbarConfig.insertKeys = props.insertKeys
    }
    if (props.excludeKeys) {
        // eslint-disable-next-line @typescript-eslint/ban-ts-comment
        // @ts-ignore
        toolbarConfig.excludeKeys = props.excludeKeys
    }

    // 编辑器配置
    const editorConfig: Partial<IEditorConfig> = {
        placeholder: props.placeholder,
        readOnly: props.disabled || props.static,
        autoFocus: props.autoFocus,
        maxLength: props.maxLength,
        MENU_CONF: {
            uploadImage: {
                server: props.uploadImageServer,
                maxFileSize: props.uploadImageMaxSize || (1024 * 1024 * 2),
                maxNumberOfFiles: props.uploadImageMaxNumber || 100,
            },
            uploadVideo: {
                server: props.uploadVideoServer,
                maxFileSize: props.uploadVideoMaxSize || (1024 * 1024 * 10),
                maxNumberOfFiles: props.uploadVideoMaxNumber || 10,
            }
        }
    }

    const initEditor = () => {
        // 禁用编辑器
        if (props.disabled || props.static) {
            editor?.disable()
        } else {
            editor?.enable()
        }
    }

    useEffect(() => {
        if (editor == null) return
        initEditor()
        setHtml(props.value || "")
    }, [props])

    useEffect(() => i18nChangeLanguage(appSettings.locale ? locale : "zh-CN"), [appSettings])

    // 及时销毁 editor ，重要！
    useEffect(() => {
        return () => {
            if (editor == null) return
            editor.destroy()
            setEditor(null)
        }
    }, [editor])

    return (
        <div className={props.className} style={{border: "1px solid var(--color-border)", zIndex: 100}}>
            {props.static || (
                <Toolbar
                    editor={editor}
                    defaultConfig={toolbarConfig}
                    mode="default"
                    style={{borderBottom: "1px solid var(--color-border)"}}
                />
            )}
            <Editor
                defaultConfig={editorConfig}
                value={html}
                onCreated={setEditor}
                onChange={editor => {
                    setHtml(editor.getHtml())
                    props.onChange(editor.getHtml())
                }}
                mode="default"
                style={{
                    overflowY: "hidden",
                    height: props.height || 400,
                }}
            />
        </div>
    )
})

export default WangEditor
