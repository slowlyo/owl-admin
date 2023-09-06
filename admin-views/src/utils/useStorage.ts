import {useEffect, useState} from 'react'

const getDefaultStorage = (key: string) => localStorage.getItem(key)

function useStorage(key: string, defaultValue?: string): [string, (key: string) => void, () => void] {
    const [storedValue, setStoredValue]: any = useState(getDefaultStorage(key) || defaultValue)

    const setStorageValue = (value: string) => {
        localStorage.setItem(key, value)
        if (value !== storedValue) {
            setStoredValue(value)
        }
    }

    const removeStorage = () => localStorage.removeItem(key)

    useEffect(() => {
        const storageValue = localStorage.getItem(key)
        if (storageValue) {
            setStoredValue(storageValue)
        }
    }, [])

    return [storedValue, setStorageValue, removeStorage]
}

export default useStorage
