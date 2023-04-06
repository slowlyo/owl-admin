declare global {
    interface Window {
        $owl: any
    }
}

export default function registerGlobalFunction(name, fn) {
    if (window.$owl) {
        window.$owl[name] = fn
    } else {
        window.$owl = {
            [name]: fn
        }
    }
}
