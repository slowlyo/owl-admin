import loadable from "@loadable/component"

// https://github.com/gregberge/loadable-components/pull/226
function load(fn, options) {
    const Component = loadable(fn, options)

    Component.preload = fn.requireAsync || fn

    return Component
}

export default (loader) => load(loader, {});
