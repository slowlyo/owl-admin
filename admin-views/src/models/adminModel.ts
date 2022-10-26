import {useCallback, useState} from "react"

export default () => {
    const [token, setToken] = useState<string | null>(null)

    const setTokenValue = useCallback((token: string) => {
        setToken(() => token)
    }, [])

    return {
        token,
        setTokenValue,
    }
}
