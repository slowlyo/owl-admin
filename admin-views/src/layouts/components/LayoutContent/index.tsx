import {Outlet} from '@@/exports'

export const LayoutContent = () => {

    return (
        <div className="p-5">
            <Outlet/>
        </div>
    )
}
