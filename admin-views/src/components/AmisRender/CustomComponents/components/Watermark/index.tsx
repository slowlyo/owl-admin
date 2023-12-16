import React, {forwardRef} from 'react'
import {WatermarkProps} from 'antd'
import {Watermark as AntdWatermark} from 'antd'

const Watermark = forwardRef((props: WatermarkProps | any) =>
    <AntdWatermark {...props}>{props.body ? props.render('body', props.body, {}) : null}</AntdWatermark>)

export default Watermark
