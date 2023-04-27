import {defineConfig} from "vite"
import react from "@vitejs/plugin-react"
import svgrPlugin from "@arco-plugins/vite-plugin-svgr"
import compression from "vite-plugin-compression"
import progress from "vite-plugin-progress"
import vitePluginForArco from "@arco-plugins/vite-react"
import UnoCSS from "unocss/vite"
import {createViteProxy} from "./src/utils/proxy"

// https://vitejs.dev/config/
export default defineConfig({
    base: "/admin/",
    resolve: {
        alias: [
            {find: "@", replacement: "/src"},
            {find: "moment/locale/zh-cn", replacement: "moment/dist/locale/zh-cn"}
        ],
    },
    plugins: [
        UnoCSS({}),
        react(),
        svgrPlugin({
            svgrOptions: {},
        }),
        vitePluginForArco({
            // theme: "@arco-themes/react-arco-pro",
            theme: "@arco-themes/react-amis-design",
            modifyVars: {},
        }),
        compression(),
        progress()
    ],
    css: {
        preprocessorOptions: {
            less: {
                javascriptEnabled: true,
            },
        },
    },
    server: {
        host: "0.0.0.0",
        port: 3200,
        open: true,
        proxy: createViteProxy(),
    },
    optimizeDeps: {
        include: [
            "lodash",
            "bizcharts",
            "amis",
            "amis-ui",
            "react-redux"
        ]
    }
})
