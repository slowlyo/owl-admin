interface Window {
    $adminApiPrefix: string;
    $owl: {
        logout: () => void,
        refreshRoutes: () => Promise,
    }
}
