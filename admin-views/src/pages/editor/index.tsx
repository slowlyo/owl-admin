import React from 'react'
import AmisEditor from '@/components/AmisEditor'
import {Card, Space} from 'antd'
import {Button as AmisBtn} from 'amis-ui'
import AmisRender from '@/components/AmisRender'
import {useLang} from '@/hooks/useLang'

const Editor = () => {
    const {t} = useLang()
    const [preview, setPreview] = React.useState(false)
    const [schema, setSchema] = React.useState({} as any)

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
        <div className="h-screen">
            <Card className="h-full" title="可视化编辑器" bodyStyle={{padding: 0, height: 'calc(100% - 46px)'}} extra={(
                <Space>
                    <AmisRender schema={btnSchema}/>
                    <AmisBtn level="primary" onClick={() => setPreview(!preview)}>
                        {preview ? t('amis_editor.edit') : t('amis_editor.preview')}
                    </AmisBtn>
                </Space>
            )}>
                <div className="w-full h-full overflow-x-auto">
                    <AmisEditor onChange={setSchema} preview={preview}/>
                </div>
            </Card>
            <div className="h-20px"></div>
        </div>
    )
}

export default Editor
