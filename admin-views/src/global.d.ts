interface Window {
    $adminApiPrefix: string,
    $owl: {
        afterLoginSuccess: (params: any, token: string) => void,
    }
}

interface BaseResponse {
    status: number,
    msg: string,
    doNotDisplayToast: number,
    code: number,
    data: any,
}

interface IRes extends BaseResponse {
}
