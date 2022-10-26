import {useCallback, useState} from "react"

export default () => {
    const [token, setToken] = useState<string | null>(null)

    const setTokenValue = useCallback((tokenValue: string) => {
        setToken(() => tokenValue)
    }, [])

    return {
        token,
        setTokenValue,
    }
}
