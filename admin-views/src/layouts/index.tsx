import {DefaultLayout} from './DefaultLayout'
import {useEffect, useState} from 'react'
import {SmLayout} from './SmLayout'
import {useSmallScreen} from '../hooks/useSmallScreen.ts'

export const Layout = () => {
    const isSmallScreen = useSmallScreen()
    const [layout, setLayout] = useState(<DefaultLayout/>)

    useEffect(() => setLayout(isSmallScreen ? <SmLayout/> : <DefaultLayout/>), [isSmallScreen])

    return layout
}
