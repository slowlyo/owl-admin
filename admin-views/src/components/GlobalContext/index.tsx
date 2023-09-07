import {createContext} from 'react'

export const GlobalContext = createContext<{
    store?: any
}>({})
