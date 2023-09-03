import React, {lazy} from 'react'

const mod = import.meta.glob('../pages/**/[a-z[]*.tsx')

export const LazyLoad = (path: string) => {
    const Component = lazy(mod[`../pages/${path}/index.tsx`] as any)
    return <React.Fragment><Component/></React.Fragment>
}
