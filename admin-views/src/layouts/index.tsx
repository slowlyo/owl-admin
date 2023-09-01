import {DefaultLayout} from './default-layout'
import {useEffect, useState} from 'react'
import {useSmallScreen} from '../utils/useSmallScreen.ts'
import {SmLayout} from './sm-layout'

export const Layout = () => {
    const isSmallScreen = useSmallScreen()
    const [layout, setLayout] = useState(<DefaultLayout/>)

    useEffect(() => setLayout(isSmallScreen ? <SmLayout/> : <DefaultLayout/>), [isSmallScreen])

    return layout
}
