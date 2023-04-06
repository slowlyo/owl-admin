import {defineConfig} from "vite"
import react from "@vitejs/plugin-react"
import svgrPlugin from "@arco-plugins/vite-plugin-svgr"
import vitePluginForArco from "@arco-plugins/vite-react"
import UnoCSS from "unocss/vite"
import {createViteProxy} from "./src/utils/proxy"

// https://vitejs.dev/config/
export default defineConfig({
    resolve: {
        alias: [{find: "@", replacement: "/src"}],
    },
    plugins: [
        UnoCSS({ }),
        react(),
        svgrPlugin({
            svgrOptions: {},
        }),
        vitePluginForArco({
            // theme: "@arco-themes/react-arco-pro",
            theme: "@arco-themes/react-amis-design",
            modifyVars: { },
        }),
    ],
    css: {
        preprocessorOptions: {
            less: {
                javascriptEnabled: true,
            },
        },
    },
    server: {
        host: '0.0.0.0',
        port: 3200,
        open: true,
        proxy: createViteProxy(),
    },
})
