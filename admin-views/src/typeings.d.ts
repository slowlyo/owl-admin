interface Window {
    $adminApiPrefix: string;
    $owl: {
        logout: () => void,
        refreshRoutes: () => Promise,
        appLoader: () => void,
        afterLoginSuccess: (params: any, token: string) => void,
    }
}

declare module "*.css" {
    const classes: { [className: string]: string }
    export default classes
}
