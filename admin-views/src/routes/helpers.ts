export const getTitle = (path: string, routes) => {
    let title = ""
    routes.map((item) => {
        if (path === item.path) {
            title = item.meta.title
            return
        } else if (item.children) {
            title = getTitle(path, item.children)
            return
        }
    })

    return title
}