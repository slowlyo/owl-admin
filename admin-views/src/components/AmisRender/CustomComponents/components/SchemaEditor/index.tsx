import React, {forwardRef} from 'react'
import AmisEditor from '@/components/AmisEditor'
import {Card, Space} from 'antd'
import {Button as AmisBtn} from 'amis-ui'
import AmisRender from '@/components/AmisRender'
import {useLang} from '@/hooks/useLang'

interface IProps {
    className?: string,
    value?: string,
    static?: boolean,
    onChange?: (schema: string) => void,
}

const SchemaEditor = forwardRef((props: IProps, ref) => {
    const {t} = useLang()
    const [preview, setPreview] = React.useState(props.static)
    const [schema, setSchema] = React.useState(props.value)

    const btnSchema = {
        type: 'button',
        label: t('amis_editor.get_php_code'),
        level: 'success',
        actionType: 'ajax',
        api: {
            method: 'post',
            url: '/dev_tools/editor_parse',
            data: {schema}
        },
        feedback: {
            title: 'PHP Schema',
            size: 'lg',
            body: {
                type: 'editor',
                language: 'php',
                name: 'schema',
            }
        }
    }

    return (
        <div className={"h-full " + props.className}>
            <Card className="h-full" title={t('amis_editor.editor')} bodyStyle={{padding: 0, height: 'calc(100% - 55px)'}} extra={(
                <Space>
                    <AmisRender schema={btnSchema}/>
                    {!props.static && (
                        <AmisBtn level="primary" onClick={() => setPreview(!preview)}>
                            {preview ? t('amis_editor.edit') : t('amis_editor.preview')}
                        </AmisBtn>
                    )}
                </Space>
            )}>
                <div className="w-full h-full overflow-x-auto">
                    <AmisEditor onChange={(value) => {
                        setSchema(value)
                        props.onChange(value)
                    }} preview={preview} defaultSchema={props.value}/>
                </div>
            </Card>
        </div>
    )
})

export default SchemaEditor
